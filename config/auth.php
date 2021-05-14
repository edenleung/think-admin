<?php

/*
 * This file is part of TAnt.
 * @link     https://github.com/edenleung/think-admin
 * @document https://www.kancloud.cn/manual/thinkphp6_0
 * @contact  QQ Group 996887666
 * @author   Eden Leung 758861884@qq.com
 * @copyright 2019 Eden Leung
 * @license  https://github.com/edenleung/think-admin/blob/6.0/LICENSE.txt
 */

use app\common\model\User;
use think\User\Drive\Session;

return [
    'default' => 'api',
    'stores'  => [
        'api' => [
            'drive' => Session::class,
            'key'   => 'uid',
            'model' => User::class,
        ],
    ],
];
