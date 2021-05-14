<?php

use app\common\model\User;
use think\User\Drive\Session;

return [
    'default' => 'api',
    'stores' => [
        'api' => [
            'drive' => Session::class,
            'key' => 'uid',
            'model' => User::class
        ]
    ]
];
