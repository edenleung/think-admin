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

class Menu extends BaseModel
{
    use ModelHelper;

    /**
     * 设置字段信息.
     *
     * @var array
     */
    protected $schema = [
        'id'                    => 'int',
        'name'                  => 'string',
        'title'                 => 'string',
        'pid'                   => 'int',
        'type'                  => 'string',
        'status'                => 'int',
        'path'                  => 'string',
        'redirect'              => 'string',
        'component'             => 'string',
        'icon'                  => 'string',
        'permission'            => 'string',
        'keeyAlive'             => 'int',
        'hidden'                => 'int',
        'hideChildrenInMenu'    => 'int',
        'blank'                 => 'int',
        'create_time'           => 'int',
        'update_time'           => 'int',
        'delete_time'           => 'int',
    ];

    public function actions()
    {
        return $this->hasMany(MenuAction::class);
    }
}
