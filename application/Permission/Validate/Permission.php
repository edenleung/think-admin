<?php
namespace app\Permission\Validate;

use think\Validate;

class Permission extends Validate
{
    protected $rule = [
        'id'      =>  'require',
        'pid'     =>  'require',
        'title'   =>  'require',
        'name'    =>  'require',
    ];

    protected $message  =   [
        'id.require'    => '标识必须',
        'pid.require'   => '父级必须',
        'title.require' => '名称必须',
        'name.require'  => '规则必须',
        'name.unique'   => '规则重复'
    ];
    
    protected $scene = [
        'update'  =>  ['pid', 'title', 'name', 'id'],
        'create'  =>  ['title', 'name', 'pid', 'status', 'action'],
        'delete'  =>  ['id']
    ];
}