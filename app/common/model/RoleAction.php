<?php

namespace app\common\model;

use think\Model;

class RoleAction extends Model
{
    public function role()
    {
        return $this->belongsTo(Role::class);
    }
}
