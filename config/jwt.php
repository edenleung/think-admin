<?php

/**
 * Jwt 配置
 */

declare(strict_types=1);
return [
	'default' => [
		'uniqidKey' => 'uid',
		'signerKey' => '5t2a$O&TUx',
		'notBefore' => 0,
		'expiresAt' => 3600,
		'refreshTTL' => 7200,
		'signer' => 'Lcobucci\JWT\Signer\Hmac\Sha256',
		'type' => 'Header',
		'refresh' => 50001,
		'relogin' => 50002,
		'iss' => '',
		'aud' => '',
	],
	'user' => ['inject' => true, 'model' => 'app\common\model\User'],
	'blacklist' => ['cacheName' => 'blacklist'],
];