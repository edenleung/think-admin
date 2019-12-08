<?php

namespace app\model;

use think\Db;
use xiaodi\Permission\Contract\UserContract;
use app\model\validate\UserValidate;
use think\exception\ValidateException;

class User extends \think\Model implements UserContract
{
    use \xiaodi\Permission\Traits\User, \app\traits\ValidateError;

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
     * 验证数据
     *
     * @param string $scene 验证场景
     * @param array $data 验证数据
     * @return void
     */
    protected function validate(string $scene, array $data)
    {
        try {
            validate(UserValidate::class)
                ->scene($scene)
                ->check($data);
        } catch (ValidateException $e) {
            $this->error = $e->getError();
            return false;
        }

        return true;
    }

    /**
     * 创建用户
     *
     * @param array $data
     * @return void
     */
    public function addUser(array $data)
    {
        if (false === $this->validate('create', $data)) {
            return false;
        }

        $user = User::create([
            'name' => $data['name'],
            'nickname' => $data['nickname'],
            'status' => $data['status'],
            'password' => $this->makePassword($data['password'])
        ]);

        //绑定角色
        $user->bindRole($data['roles']);
    }

    public function updateUser(int $id, array $data)
    {
        if (false === $this->validate('update', $data)) {
            return false;
        }

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
        if (empty($data['roles'])) {
            $user->bindRole($data['roles']);
        }
    }

    /**
     * 删除用户
     *
     * @param integer $id
     * @return void
     */
    public function deleteUser(int $id)
    {
        $user = $this->find($id);
        if (empty($user)) {
            return false;
        }

        // 解除所有已绑定角色
        $user->removeAllRole();
        return $user->delete();
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

    /**
     * 绑定角色.
     *
     * @param array $roles
     * @return void
     */
    protected function bindRole(array $roles)
    {
        $roles = implode(',', $roles);

        //绑定角色
        $roles = Role::whereIn('id', $roles)->select();

        foreach ($roles as $role) {
            $this->assignRole($role);
        }
    }
}
