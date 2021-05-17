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
use app\common\traits\ModelHelper;

class Role extends BaseModel
{
    use ModelHelper;

    protected $schema = [
        'id'             => 'int',
        'title'          => 'string',
        'status'         => 'int',
        'create_time'    => 'int',
        'update_time'    => 'int',
        'delete_time'    => 'int',
    ];

    public function rules()
    {
        return $this->hasMany(Rule::class, 'v0', 'title', 'v0')->where('ptype', 'p');
    }

    public function actions()
    {
        return $this->hasMany(RoleAction::class);
    }
}
