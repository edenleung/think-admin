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

class Tasker extends Command
{
    protected $interval = 1;

    protected $count = 1;

    protected $name = 'TaskServer';

    protected $tasks = [
        \app\tasks\Example::class,
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
        foreach($this->tasks as $task)
        {
            \call_user_func_array([new $task, 'register'], []);
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
        $worker->count = $this->count;
        $worker->onWorkerStart = [$this, 'start'];
        $worker->runAll();
    }
}
