<?php

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
                'iss'              => '',
                'aud'              => '',
                'automaticRenewal' => true,
            ],
            'user' => [
                'bind'   => true,
                'model'  => 'app\common\model\User',
            ],
            'blacklist' => [
                'cacheKey' => 'blacklist',
            ],
        ],
    ],
];
