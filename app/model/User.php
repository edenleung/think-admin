<?php

namespace app\model;

use think\Db;
use xiaodi\Permission\Contract\UserContract;

class User extends \think\Model implements UserContract
{
    use \xiaodi\Permission\Traits\User;

    /**
     * 生成密码.
     *
     * @param string $password
     * @return string
     */
    protected function makePassword(string $password)
    {
        return password_hash($password, PASSWORD_DEFAULT);
    }

    /**
     * 绑定角色.
     *
     * @param string $roles
     * @return void
     */
    protected function bindRole(string $roles)
    {
        //绑定角色
        $roles = Role::whereIn('id', $roles)->select();

        foreach ($roles as $role) {
            $this->assignRole($role);
        }
    }

    /**
     * 创建用户
     *
     * @param array $data
     * @return void
     */
    public function addUser(array $data)
    {
        $user = User::create([
            'name' => $data['name'],
            'nickname' => $data['nickname'],
            'status' => $data['status'],
            'password' => $this->makePassword($data['password'])
        ]);

        //绑定角色
        $user->bindRole(implode(',', $data['roles']));
    }

    public function updateUser(int $id, array $data)
    {
        $user = $this->find($id);

        // 重置密码
        if (isset($data['password'])) {
            $user->password = $this->makePassword($data['password']);
        }

        $user->save([
            'name' => $data['name'],
            'nickname' => $data['nickname'],
            'status' => $data['status']
        ]);

        // 解除所有已绑定角色
        $user->removeAllRole();

        // 重新绑定角色
        $user->bindRole(implode(',', $data['roles']));
    }

    public function deleteUser(int $id)
    {
        $user = $this->find($id);

        // 解除所有已绑定角色
        $user->removeAllRole();
        
        $user->delete();
    }

    public function getList(int $page, int $pageSize)
    {
        $total = $this->where('id', '<>', config('permission.super_id'))->count();
        $users = $this->where('id', '<>', config('permission.super_id'))->limit($pageSize)->page($page)->select();
        foreach ($users as $user) {
            $rules = $user->getAllPermissions()->column('id');
            $user->rules = $rules;
        }

        $data = ['data' => $users, 'pagination' => ['total' => $total, 'current' => intval($page), 'pageSize' => intval($pageSize)]];
        return $data;
    }
}
