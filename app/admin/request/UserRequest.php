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

class UserRequest extends BaseRequest
{
    protected $rule = [
        'name'     => 'require|unique:user',
        'nickname' => 'require',
        'password' => 'require',
        'roles'    => 'require',
    ];

    protected $message = [
        'name.require'     => '登录账号必须',
        'name.unique'      => '登录账号重复',
        'nickname.require' => '名称必须',
        'password.require' => '密码必须',
        'roles.require'    => '角色必须',
    ];

    protected $scene = [
        'create' => ['name', 'nickname', 'password'],
        'update' => ['name', 'nickname'],
    ];
}
