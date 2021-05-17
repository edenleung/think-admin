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

namespace app\common\model;

use think\Model;
use Auth\User\AuthorizationUserInterface;

class Member extends Model implements AuthorizationUserInterface
{
    /**
     * 设置字段信息.
     *
     * @var array
     */
    protected $schema = [
        'id'             => 'int',
        'username'       => 'string',
        'password'       => 'string',
        'create_time'    => 'int',
        'update_time'    => 'int',
        'delete_time'    => 'int',
    ];

    public function hasUserByUserName($username): bool
    {
        return $this->where('username', $username)->find() ? true : false;
    }

    public function getUserByUserName($username): self
    {
        return $this->where('username', $username)->find();
    }

    public function verifyPassword($password): bool
    {
        return password_verify($password, $this->getPassword());
    }

    public function setUserName($username): self
    {
        $this->username = $username;

        return $this;
    }

    public function setPassword($password): self
    {
        $this->password = $password;

        return $this;
    }

    public function token(): string
    {
        return app('jwt')->token($this->id)->toString();
    }
}
