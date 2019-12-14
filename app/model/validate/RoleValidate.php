<?php

declare(strict_types=1);
/**
 * This file is part of ThinkPHP.
 * @link     https://github.com/xiaodit/think-admin
 * @document https://www.kancloud.cn/manual/thinkphp6_0
 * @contact  group@thinkphp.cn
 * @author   XiaoDi 758861884@qq.com
 * @copyright 2019 Xiaodi
 * @license  https://github.com/xiaodit/think-admin/blob/6.0/LICENSE.txt
 */

namespace app\model\validate;

use think\Validate;

class RoleValidate extends Validate
{
    protected $rule = [
        'name' => 'require|unique:role',
        'title' => 'require',
    ];

    protected $message = [
        'name.require' => '唯一标识必须',
        'name.unique' => '唯一标识重复',
        'title.require' => '名称必须',
    ];

    protected $scene = [
        'update' => ['title', 'name'],
        'create' => ['title', 'name'],
    ];
}
