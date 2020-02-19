<?php

/**
 * Jwt 配置.
 */

declare(strict_types=1);
/**
 * This file is part of TAnt.
 * @link     https://github.com/edenleung/think-admin
 * @document https://www.kancloud.cn/manual/thinkphp6_0
 * @contact  QQ Group 996887666
 * @author   Eden Leung 758861884@qq.com
 * @copyright 2019 Eden Leung
 * @license  https://github.com/edenleung/think-admin/blob/6.0/LICENSE.txt
 */

return [
    'sso'         => false,
    'ssoCacheKey' => 'jwt-auth-user',
    'ssoKey'      => 'uid',
    'signerKey'   => 'RvAjzUhtJs',
    'notBefore'   => 0,
    'expiresAt'   => 3600,
    'signer'      => 'Lcobucci\JWT\Signer\Hmac\Sha256',
    'injectUser'  => true,
    'userModel'   => \app\model\User::class,
    'hasLogged'   => 50401,
    'tokenAlready' => 50402
];
