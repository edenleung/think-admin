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

interface AuthorizationUserInterface
{
    public function hasUserByUserName($username) :bool;
    public function getUserByUserName($username): AuthorizationUserInterface;
    public function verifyPassword($password): bool;
    public function setUserName($username): AuthorizationUserInterface;
    public function setPassword($password): AuthorizationUserInterface;
    public function token(): string;
}
