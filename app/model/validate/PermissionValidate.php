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

class PermissionValidate extends Validate
{
    protected $rule = [
        'name' => 'require|unique:permission',
        'title' => 'require',
        'pid' => 'require',
    ];

    protected $message = [
        'pid.require' => '父级必须',
        'title.require' => '名称必须',
        'name.require' => '规则必须',
        'name.unique' => '规则重复',
    ];

    protected $scene = [
        'create' => ['title', 'name', 'pid'],
        'update' => ['title', 'name', 'pid'],
    ];
}
