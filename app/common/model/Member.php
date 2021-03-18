<?php

namespace app\common\model;

use app\auth\AuthorizationUserInterface;
use think\Model;

class Member extends Model implements AuthorizationUserInterface
{
    public function username()
    {
        return 'username';
    }

    public function password()
    {
        return 'password';
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

    public function createAccount(array $data)
    {
        $this->username = $data['username'];
        $this->password = password_hash($data['password'], PASSWORD_DEFAULT);
        $this->save();

        return $this;
    }

    public function makeToken()
    {
        return app('jwt')->token($this->id)->toString();
    }
}
