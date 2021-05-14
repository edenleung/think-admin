<?php

declare(strict_types=1);

/*
 * This file is part of TAnt.
 * @link     https://github.com/edenleung/think-admin
 * @document https://www.kancloud.cn/manual/thinkphp6_0
 * @contact  QQ Group 996887666
 * @author   Eden Leung 758861884@qq.com
 * @copyright 2019 Eden Leung
 * @license  https://github.com/edenleung/think-admin/blob/6.0/LICENSE.txt
 */

namespace app\command;

use Workerman\Worker;
use think\console\Input;
use think\console\Output;
use think\console\Command;
use think\console\input\Option;
use think\console\input\Argument;

class Crontab extends Command
{
    protected $interval = 1;

    protected $count = 1;

    protected $name = 'TaskServer';

    protected $crontabs = [
        'example' => ['1 * * * * *', [\app\task\Example::class, 'execute']]
    ];

    protected function configure()
    {
        // 指令配置
        $this->setName('tasker')
            ->addArgument('action', Argument::OPTIONAL, 'start|stop|restart|reload|status|connections', 'start')
            ->addOption('mode', 'm', Option::VALUE_OPTIONAL, 'Run the workerman server in daemon mode.')
            ->setDescription('定时任务');
    }

    public function start()
    {
        foreach ($this->crontabs as $name => $crontab) {
            list($rule, $config) = $crontab;
            list($class, $method) = $config;
            new \Workerman\Crontab\Crontab($rule, [make($class), $method], $name);
        }
    }

    protected function init(Input $input, Output $output)
    {
        $action = $input->getArgument('action');
        $mode = $input->getOption('mode');
        global $argv;

        $argv = [];

        array_unshift($argv, 'think', $action);
        if ($mode == 'd') {
            $argv[] = '-d';
        } elseif ($mode == 'g') {
            $argv[] = '-g';
        }
    }

    protected function execute(Input $input, Output $output)
    {
        $this->init($input, $output);

        // 指令输出
        $worker = new Worker();
        $worker->name = $this->name;
        $worker->count = 2;

        $worker2 = new Worker();
        $worker2->name = 'Crontab';
        $worker2->count = 4;
        $worker2->onWorkerStart = [$this, 'start'];

        $task_worker = new Worker('Text://0.0.0.0:12345');
        $task_worker->count = 100;
        $task_worker->reusePort = true;
        $task_worker->name = 'TaskWorker';
        $task_worker->onMessage = function ($connection, $task_data) {
            $connection->close();
            $task_data = json_decode($task_data, true);
            $time = mt_rand(1, 2);
            // echo '正在处理' . $task_data['args']['contents'] . '预计花费' . $time . '秒' . "\n";

            $ch = curl_init();
            //设置选项，包括URL
            curl_setopt($ch, CURLOPT_URL, "http://192.168.50.66/");
            curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
            curl_setopt($ch, CURLOPT_HEADER, 0);
            //执行并获取HTML文档内容
            $output = curl_exec($ch);
            //释放curl句柄
            curl_close($ch);
            //打印获得的数据
            echo '已处理' . $task_data['args']['contents'] . "\n";
        };
        $worker->runAll();
    }
}
