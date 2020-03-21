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

class PermissionRequest extends BaseRequest
{
    protected $rule = [
        'name'  => 'require|unique:permission',
        'title' => 'require',
        'pid'   => 'require',
    ];

    protected $message = [
        'pid.require'   => '父级必须',
        'title.require' => '名称必须',
        'name.require'  => '规则必须',
        'name.unique'   => '规则重复',
    ];

    protected $scene = [
        'create' => ['name', 'title', 'pid'],
        'update' => ['title', 'pid'],
    ];
}
