<?php

/**
 * Jwt 配置.
 */

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

return [
    'sso'           => true,
    'sso_cache_key' => 'jwt-auth-user',
    'sso_key'       => 'uid',
    'signer_key'    => 'RvAjzUhtJs',
    'not_before'    => 0,
    'expires_at'    => 3600,
    'signer'        => 'Lcobucci\JWT\Signer\Hmac\Sha256',
    'claims'        => ['iss' => '', 'aud' => ''],
    'inject_user'   => true,
    'user_model'    => \app\model\User::class,
];
