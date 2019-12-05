<?php

/**
 * Jwt 配置
 */

declare(strict_types=1);
return [
	'sso' => true,
	'sso_key' => 'uid',
	'signer_key' => 'xTh5LDyli6',
	'not_before' => 0,
	'expires_at' => 3600,
	'signer' => 'Lcobucci\JWT\Signer\Hmac\Sha256',
	'claims' => ['iss' => '', 'aud' => ''],
	'inject_user' => true,
	'user_model' => \app\model\User::class,
];