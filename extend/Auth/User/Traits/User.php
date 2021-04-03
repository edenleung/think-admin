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

namespace Auth\User\Traits;

trait User
{
    public function username()
    {
        return 'username';
    }

    public function password()
    {
        return 'password';
    }

    public function verifyPassword(string $password)
    {
        return password_verify($password, $this->getPassword());
    }

    public function getPassword()
    {
        return $this->getData($this->password());
    }

    public function hasUser(string $username)
    {
        return $this->where($this->username(), $username)->find() ? true : false;
    }

    public function getUser(string $username)
    {
        return $this->where($this->username(), $username)->find();
    }

    public function makeToken()
    {
        return app('jwt')->token($this->id)->toString();
    }
}
