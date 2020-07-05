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
    'default' => 'admin',
    'apps'    => [
        'admin' => [
            'token' => [
                'uniqidKey'        => 'uid',
                'signerKey'        => 'RvAjzUhtJs',
                'notBefore'        => 0,
                'expiresAt'        => 3600,
                'refreshTTL'       => 7200,
                'signer'           => 'Lcobucci\JWT\Signer\Hmac\Sha256',
                'type'             => 'Header',
                'refresh'          => 50001,
                'relogin'          => 50002,
                'iss'              => 'client.tant',
                'aud'              => 'server.tant',
                'automaticRenewal' => false,
            ],
            'user' => [
                'bind'   => true,
                'model'  => 'app\\common\\model\\User',
            ],
        ],
    ],
    'manager' => [
        // 缓存前缀
        'prefix' => 'jwt',
        // 黑名单缓存名
        'blacklist' => 'blacklist',
        // 白名单缓存名
        'whitelist' => 'whitelist',
    ],
];
