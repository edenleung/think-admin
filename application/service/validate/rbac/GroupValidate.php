<?php
namespace app\service\validate\rbac;

use think\Validate;

/**
 * 用户分组验证类
 *
 */
class GroupValidate extends Validate
{
    protected $rule = [
        'id'      =>  'require',
        'title'   =>  'require',
        'rules'    =>  'require',
    ];

    protected $message  =   [
        'id.require'    => '标识必须',
        'title.require' => '名称必须',
        'rules.require'  => '规则必须',
    ];

    protected $scene = [
        'update'  =>  ['title', 'id'],
        'create'  =>  ['title', 'rules'],
        'delete'  =>  ['id']
    ];
}
