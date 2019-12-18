<?php

declare(strict_types=1);
/**
 * This file is part of ThinkPHP.
 * @link     https://github.com/xiaodit/think-admin
 * @document https://www.kancloud.cn/manual/thinkphp6_0
 * @contact  group@thinkphp.cn
 * @author   XiaoDi 758861884@qq.com
 * @copyright 2019 Xiaodi
 * @license  https://github.com/xiaodit/think-admin/blob/6.0/LICENSE.txt
 */

namespace app\model;

use app\model\validate\UserValidate;
use think\exception\ValidateException;
use xiaodi\Permission\Contract\UserContract;

class User extends \think\Model implements UserContract
{
    use \app\traits\CurdEvent;

    use \xiaodi\Permission\Traits\User;
    use \app\traits\ValidateError;

    /**
     * 创建用户.
     */
    public function addUser(array $data)
    {
        if ($this->validate('create', $data) === false) {
            return false;
        }

        $hash = randomKey();
        $user = User::create([
            'name' => $data['name'],
            'nickname' => $data['nickname'],
            'status' => $data['status'],
            'hash'   => $hash,
            'password' => $this->makePassword($data['password'], $hash),
        ]);

        //绑定角色
        $user->bindRole($data['roles']);
    }

    public function updateUser(int $id, array $data)
    {
        if ($this->validate('update', $data) === false) {
            return false;
        }

        $user = $this->find($id);

        // 重置密码
        if (isset($data['password'])) {
            $hash = randomKey();
            $user->hash = $hash;
            $user->password = $this->makePassword($data['password'], $hash);
        }

        $user->save([
            'name' => $data['name'],
            'nickname' => $data['nickname'],
            'status' => $data['status'],
        ]);

        // 解除所有已绑定角色
        $user->removeAllRole();

        // 重新绑定角色
        if (!empty($data['roles'])) {
            $user->bindRole($data['roles']);
        }
    }

    /**
     * 删除用户.
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

    /**
     * 获取用户列表
     *
     * @param int $page
     * @param int $pageSize
     * @return void
     */
    public function getList(int $page, int $pageSize)
    {
        $total = $this->where('id', '<>', config('permission.super_id'))->count();
        $users = $this->where('id', '<>', config('permission.super_id'))->limit($pageSize)->page($page)->select();
        foreach ($users as $user) {
            $rules = $user->getAllPermissions()->column('id');
            $user->rules = $rules;
        }

        return ['data' => $users, 'pagination' => ['total' => $total, 'current' => intval($page), 'pageSize' => intval($pageSize)]];
    }

    /**
     * 更新头像.
     */
    public function updateAvatar(string $path)
    {
        $this->avatar = 'storage' . \DIRECTORY_SEPARATOR . $path;
        return $this->save();
    }

    /**
     * 更新个人信息.
     */
    public function updateCurrent(array $data)
    {
        return $this->save($data);
    }

    /**
     * 生成密码.
     *
     * @param string $password
     * @param string $hash
     * @return void
     */
    protected function makePassword(string $password, string $hash)
    {
        $pwd_peppered = hash_hmac("sha256", $password, $hash);
        return password_hash($pwd_peppered, PASSWORD_DEFAULT);
    }

    /**
     * 验证数据.
     *
     * @param string $scene 验证场景
     * @param array $data 验证数据
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
     * 绑定角色.
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

    /**
     * 验证用户密码
     * @param string $password
     * @return void
     */
    public function verifyPassword(string $password)
    {
        $pwd_peppered = hash_hmac("sha256", $password, $this->hash);

        return \password_verify($pwd_peppered, $this->password);
    }

    /**
     * 修改密码
     *
     * @param string $oldPassword
     * @param string $newPassword
     * @return void
     */
    public function resetPassword(string $oldPassword, string $newPassword)
    {
        if (!$this->verifyPassword($oldPassword)) {
            $this->error = '原密码不正确';
            return false;
        }

        $this->hash = randomKey();
        $this->password = $this->makePassword($newPassword, $this->hash);

        return  $this->save();
    }
}
