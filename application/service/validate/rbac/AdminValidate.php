<?php
namespace app\service\validate\rbac;

use think\Validate;

/**
 * 后台用户验证类
 */
class AdminValidate extends Validate
{
    protected $rule = [
        'admin_user'      =>  'require',
        'admin_password'   =>  'require',
        'groups'   =>  'require',
    ];

    protected $message  =   [
        'admin_user.require'    => '账号必须',
        'admin_user.unique' => '账号重复',
        'admin_password.require' => '密码必须',
        'groups.require' => '用户组必须',
    ];

    protected $scene = [
        'edit'    =>  ['admin_user', 'groups', 'admin_id'],
        'create'  =>  ['admin_user', 'admin_password', 'groups'],
        'delete'  =>  ['admin_id']
    ];
}
