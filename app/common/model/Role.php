<?php

namespace app\common\model;

use think\Model;

class Role extends Model
{
    public function rules()
    {
        return $this->hasMany(Rule::class, 'v0', 'title', 'v0')->where('ptype', 'p');
    }

    public function actions()
    {
        return $this->hasMany(RoleAction::class);
    }
}
