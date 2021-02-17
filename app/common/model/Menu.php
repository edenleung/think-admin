<?php

namespace app\common\model;

use app\BaseModel;

class Menu extends BaseModel
{
    public function actions()
    {
        return $this->hasMany(MenuAction::class);
    }
}
