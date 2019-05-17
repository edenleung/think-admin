<?php
namespace app\Permission\Validate;

use think\Validate;

class Role extends Validate
{
    protected $rule = [
        'id'      =>  'require',
        'title'   =>  'require',
        'status'  =>   'require'
    ];

    protected $message  =   [
        'id.require'     => '标识必须',
        'title.require'  => '名称必须',
        'status.require' => '状态必须',
    ];

    protected $scene = [
        'update'  =>  ['title', 'status'],
        'create'  =>  ['title', 'status'],
        'delete'  =>  ['id']
    ];
}
