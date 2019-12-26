<?php

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

namespace app\service;

use app\event\UserLogin;
use app\model\User;
use xiaodi\Jwt;

class UserService
{
    protected $user;

    protected $jwt;

    public function __construct(Jwt $jwt)
    {
        $this->jwt = $jwt;
    }

    /**
     * 用户登录.
     */
    public function login(string $username, string $password)
    {
        $user = User::getByName($username);
        if (empty($user)) {
            return false;
        }

        if (! $user->verifyPassword($password)) {
            return false;
        }

        $this->user = $user;

        event('UserLogin', new UserLogin($this->user));
        return true;
    }

    public function makeToken()
    {
        return $this->jwt->token(['uid' => $this->user->id]);
    }
}
