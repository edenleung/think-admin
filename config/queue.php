<?php
// +----------------------------------------------------------------------
// | ThinkPHP [ WE CAN DO IT JUST THINK IT ]
// +----------------------------------------------------------------------
// | Copyright (c) 2006-2016 http://thinkphp.cn All rights reserved.
// +----------------------------------------------------------------------
// | Licensed ( http://www.apache.org/licenses/LICENSE-2.0 )
// +----------------------------------------------------------------------
// | Author: yunwuxin <448901948@qq.com>
// +----------------------------------------------------------------------

return [
    'connector'  => 'Redis',		    // Redis 驱动
    'expire'     => 60,				// 任务的过期时间，默认为60秒; 若要禁用，则设置为 null 
    'default'    => 'default',		// 默认的队列名称
    'host'       => '127.0.0.1',	    // redis 主机ip
    'port'       => 6379,			// redis 端口
    'password'   => '',				// redis 密码
    'select'     => 0,				// 使用哪一个 db，默认为 db0
    'timeout'    => 0,				// redis连接的超时时间
    'persistent' => false,
];
