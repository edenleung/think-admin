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

namespace app\auth;

interface AuthorizationUserInterface
{
    public function username();

    public function password();

    public function hasUser(string $username);

    public function getUser(string $username);

    public function getPassword();

    public function createAccount(array $data);

    public function makeToken();
}
