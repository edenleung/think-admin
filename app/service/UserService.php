<?php

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
     * 用户登录
     *
     * @param [type] $username
     * @param [type] $password
     * @return void
     */
    public function login($username, $password)
    {
        $user = User::findByName($username);
        if (empty($user)) {
            return false;
        }

        if (!\password_verify($password, $user->password)) {
            return false;
        }

        $this->user = $user;

        event('UserLogin', new UserLogin($this->user));
        return true;
    }

    public function makeToken()
    {
        $token = $this->jwt->token(['uid' => $this->user->id]);
        return $token;
    }
}
