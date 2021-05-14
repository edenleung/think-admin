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

namespace Auth\User;

use TAnt\Abstracts\AbstractService;
use Auth\User\Exception\Unauthorized;

class AuthService extends AbstractService
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
        $row = $this->member->hasUserByUserName($username);

        if ($row) {
            $user = $this->member->getUserByUserName($username);
            if (!$user->verifyPassword($password)) {
                throw new Unauthorized('账号密码错误');
            }

            return $user;
        }

        throw new Unauthorized('没有此账号');
    }

    public function register($username, $password, $params = [])
    {
        $row = $this->member->hasUserByUserName($username);
        if (!$row) {
            $member = $this->member->setUserName($username)->setPassword($password);

            foreach ($params as $key => $value) {
                $member->$key = $value;
            }

            $member->save($params);
        }

        throw new Unauthorized('此账号已注册');
    }
}
