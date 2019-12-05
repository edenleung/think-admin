<?php

namespace app\service;

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
        return true;
    }

    public function makeToken()
    {
        $token = $this->jwt->getToken(['uid' => $this->user->id]);
        return $token;
    }

    public function getUserInfoByToken($token)
    {
        if(true === $this->jwt->verify($token)){
            return $this->jwt->user();
        }
    }
}
