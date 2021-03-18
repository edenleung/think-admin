<?php

namespace app\auth;

use app\BaseService;
use app\auth\AuthorizationUserInterface;

class AuthService extends BaseService
{
    /**
     * @var AuthorizationUserInterface
     */
    protected $member;

    public function __construct(AuthorizationUserInterface $member)
    {
        $this->member = $member;
    }

    public function login(string $username, string $password)
    {
        $row = $this->member->hasUser($username);

        if ($row) {
            $user = $this->member->getUser($username);
            if (!password_verify($password, $user->getPassword())) {
                $this->error = '账号密码错误';
                return false;
            }

            return $user;
        }

        $this->error = '没有此账号';
        return false;
    }

    public function register(array $data)
    {
        $row = $this->member->hasUser($data[$this->member->username()]);
        if (!$row) {
            return $this->member->createAccount($data);
        } else {
            $this->error = '此账号已注册';
            return false;
        }
    }
}
