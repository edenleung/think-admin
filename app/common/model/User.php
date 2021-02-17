<?php

namespace app\common\model;

use app\BaseModel;
use tauthz\facade\Enforcer;

class User extends BaseModel
{
    public function can($source, $action)
    {
        if ($this->id !== 1) {
            return Enforcer::enforce($this->username, $source, $action);
        }

        return true;
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
