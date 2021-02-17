<?php

namespace app\common\model;

use app\BaseModel;

class MenuAction extends BaseModel
{
    public function menu()
    {
        return $this->belongsTo(Menu::class);
    }
}
