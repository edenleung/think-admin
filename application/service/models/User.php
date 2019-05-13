<?php
namespace app\service\models;

use xiaodi\Permission\Models\User as Model;

/**
 * 后台用户
 * 
 */
class User extends Model
{
    public function setAdminPasswordAttr($value)
    {
        return password_hash($value, PASSWORD_DEFAULT);
    }

    /**
     * 获取用户信息
     * @param string|array $id
     */
    public function getInfo($map)
    {
        $user = $this->getOrFail($map);

        return $user;
    }

    /**
     * 用户列表
     *
     * @param [type] $page
     * @param [type] $pageSize
     * @return void
     */
    public function getList($page, $pageSize)
    {
        $total = $this->where('id', '<>', config('permission.auth_super_id'))->count();
        $users = $this->where('id', '<>', config('permission.auth_super_id'))->limit($pageSize)->page($page)->field('admin_password', true)->select();
        foreach($users as $user) {
            $roles = $user->getRoleNames()->toArray();
            $rules = $user->getAllPermissions();
            $user->rules = $rules;
            $user->roles = array_column($roles, 'id');
        }

        $data = ['data' => $users, 'pagination' => ['total' => $total, 'current' => intval($page), 'pageSize' => intval($pageSize)]];
        return $data;
    }
}
