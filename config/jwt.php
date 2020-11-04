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

return [
    'stores' => [
        'admin' => [
            'sso' => [
                'enable' => false,
            ],
            'token' => [
                'unique_id_key'    => 'uid',
                'signer_key'    => 'tant',
                'not_before'    => 0,
                'expires_at'    => 3600,
                'refresh_ttL'   => 7200,
                'signer'       => 'Lcobucci\JWT\Signer\Hmac\Sha256',
                'type'         => 'Header',
                'relogin_code'      => 50001,
                'refresh_code'      => 50002,
                'iss'          => 'client.tant',
                'aud'          => 'server.tant',
                'automatic_renewal' => false,
            ],
            'user' => [
                'bind' => true,
                'class'  => 'app\\common\\model\\User',

            ]
        ]
    ],
    'manager' => [
        // 缓存前缀
        'prefix' => 'jwt',
        // 黑名单缓存名
        'blacklist' => 'blacklist',
        // 白名单缓存名
        'whitelist' => 'whitelist'
    ]
];
