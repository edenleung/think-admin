<?php

declare(strict_types=1);
/**
 * This file is part of ThinkPHP.
 * @link     https://www.thinkphp.cn
 * @document https://www.kancloud.cn/manual/thinkphp6_0
 * @contact  group@thinkphp.cn
 * @license  https://github.com/top-think/think/blob/6.0/LICENSE.txt
 */

return [
    'bind' => [
        'UserLogin' => 'app\event\UserLogin'
    ],

    'listen' => [
        'AppInit' => [],
        'HttpRun' => [],
        'HttpEnd' => [],
        'LogLevel' => [],
        'LogWrite' => [],
        'UserLogin' => ['app\listener\UserLogin'],
    ],

    'subscribe' => [
        'app\subscribe\User'
    ],
];
