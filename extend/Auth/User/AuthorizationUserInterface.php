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
    /**
     * 登录账号字段.
     */
    public function username();

    /**
     * 登录密码字段.
     */
    public function password();

    /**
     * 是否存在用户.
     */
    public function hasUser(string $username);

    /**
     * 获取用户.
     */
    public function getUser(string $username);

    /**
     * 获取密码
     */
    public function getPassword();

    /**
     * 创建账号.
     */
    public function createAccount(array $data);

    /**
     * 生成Token.
     */
    public function makeToken();

    /**
     * 验证密码
     */
    public function verifyPassword(string $password);
}
