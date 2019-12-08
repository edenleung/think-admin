<?php

namespace app\model\validate;

use think\Validate;

class PermissionValidate extends Validate
{
    protected $rule = [
        'name'    =>  'require|unique:permission',
        'title'   =>  'require',
        'pid'     =>  'require',
    ];

    protected $message  =   [
        'pid.require'   => '父级必须',
        'title.require' => '名称必须',
        'name.require'  => '规则必须',
        'name.unique'   => '规则重复'
    ];

    protected $scene = [
        'create'  =>  ['title', 'name', 'pid'],
        'update'  =>  ['title', 'name', 'pid']
    ];
}
