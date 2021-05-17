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

use app\common\traits\ModelHelper;

class Dept extends \think\Model
{
    use ModelHelper;

    /**
     * 设置字段信息.
     *
     * @var array
     */
    protected $schema = [
        'id'             => 'int',
        'title'          => 'string',
        'pid'            => 'int',
        'status'         => 'int',
        'sort'           => 'int',
        'create_time'    => 'int',
        'update_time'    => 'int',
        'delete_time'    => 'int',
    ];
}
