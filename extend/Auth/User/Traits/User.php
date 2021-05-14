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
    public function hasUserByUserName($username)
    {
        return $this->where('username', $username)->find() ? true : false;
    }

    public function getUserByUserName($username)
    {
        return $this->where('username', $username)->find();
    }

    public function verifyPassword($password)
    {
        return password_verify($password, $this->password);
    }

    public function setUserName($username)
    {
        $this->username = $username;

        return $this;
    }

    public function setPassword($password)
    {
        $this->password = $password;

        return $this;
    }
}
