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

namespace app\task;

use \Workerman\Connection\AsyncTcpConnection;

class Example
{
    public function execute()
    {
        for ($i = 0; $i < 10000; $i++) {
            $task_connection = new AsyncTcpConnection('Text://0.0.0.0:12345');
            // 任务及参数数据
            $task_data = array(
                'function' => 'send_mail',
                'args'       => array('contents' => $i),
            );

            // 发送数据
            // 执行异步连接
            $task_connection->send(json_encode($task_data));
            $task_connection->connect();
        }
    }
}
