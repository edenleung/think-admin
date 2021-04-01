<?php

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
