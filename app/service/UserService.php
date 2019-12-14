<?php

declare(strict_types=1);
/**
 * This file is part of ThinkPHP.
 * @link     https://github.com/xiaodit/think-admin
 * @document https://www.kancloud.cn/manual/thinkphp6_0
 * @contact  group@thinkphp.cn
 * @author   XiaoDi 758861884@qq.com
 * @copyright 2019 Xiaodi
 * @license  https://github.com/xiaodit/think-admin/blob/6.0/LICENSE.txt
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
     *
     * @param string $username
     * @param string $password
     */
    public function login(string $username, string $password)
    {
        $user = User::findByName($username);
        if (empty($user)) {
            return false;
        }

        if (!$user->verifyPassword($password)) {
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
