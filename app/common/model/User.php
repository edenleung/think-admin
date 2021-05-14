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

use app\BaseModel;
use tauthz\facade\Enforcer;
use think\User\AuthorizationUserInterface;

class User extends BaseModel implements AuthorizationUserInterface
{
    use \think\User\Traits\User;

    public function getUserById($id): self
    {
        return $this->where('id', $id)->find();
    }

    public function token(): string
    {
        return app('jwt')->token($this->id)->toString();
    }

    public function can($source, $action)
    {
        if (!$this->super()) {
            return Enforcer::enforce($this->username, $source, $action);
        }

        return true;
    }

    public function super()
    {
        return $this->id === 1;
    }

    public function roles()
    {
        return $this->hasMany(Rule::class, 'v0', 'username')->where('ptype', 'g');
    }

    public function dept()
    {
        return $this->belongsTo(Dept::class);
    }

    public function setPasswordAttr($value)
    {
        if ($value) {
            return password_hash($value, PASSWORD_DEFAULT);
        }
    }
}
