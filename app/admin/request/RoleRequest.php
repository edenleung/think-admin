<?php

declare(strict_types=1);

/*
 * This file is part of TAnt.
 * @link     https://github.com/edenleung/think-admin
 * @document https://www.kancloud.cn/manual/thinkphp6_0
 * @contact  QQ Group 996887666
 * @author   Eden Leung 758861884@qq.com
 * @copyright 2019 Eden Leung
 * @license  https://github.com/edenleung/think-admin/blob/6.0/LICENSE.txt
 */

namespace app\admin\request;

use app\BaseRequest;

class RoleRequest extends BaseRequest
{
    protected $rule = [
        'name'  => 'require|unique:role',
        'title' => 'require',
    ];

    protected $message = [
        'name.require'  => '唯一标识必须',
        'name.unique'   => '唯一标识重复',
        'title.require' => '名称必须',
    ];

    protected $scene = [
        'create' => ['name', 'title'],
        'update' => ['name', 'title'],
    ];
}
