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
use app\common\traits\ModelHelper;

class RoleAction extends Model
{
    use ModelHelper;

    protected $schema = [
        'id'    => 'int',
        'role_id' => 'int',
        'menu_action_id'    => 'int',
    ];

    public function role()
    {
        return $this->belongsTo(Role::class);
    }
}
