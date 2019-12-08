<?php

namespace app\model\validate;

use think\Validate;

class RoleValidate extends Validate
{
    protected $rule = [
        'name'   =>  'require|unique:role',
        'title'   =>  'require'
    ];

    protected $message  =   [
        'name.require'   => '唯一标识必须',
        'name.unique'    => '唯一标识重复',
        'title.require'  => '名称必须',
    ];

    protected $scene = [
        'update'  =>  ['title', 'name'],
        'create'  =>  ['title', 'name']
    ];
}
