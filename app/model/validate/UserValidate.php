<?php

namespace app\model\validate;

use think\Validate;

class UserValidate extends Validate
{
    protected $rule = [
        'name'     =>  'require|unique:user',
        'nickname' =>  'require',
        'password' =>  'require',
        'roles'     =>  'require',
    ];

    protected $message  =   [
        'name.require'  => '登录账号必须',
        'name.unique'   => '登录账号重复',
        'nickname.require' => '名称必须',
        'password.require' => '密码必须',
        'roles.require'  => '角色必须',
    ];

    protected $scene = [
        'create'  =>  ['name', 'nickname', 'password', 'role'],
        'update'  =>  ['name', 'nickname']
    ];
}
