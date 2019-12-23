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

use app\model\validate\RoleValidate;
use think\exception\ValidateException;
use xiaodi\Permission\Contract\RoleContract;

class Role extends \think\Model implements RoleContract
{
    use \app\traits\CurdEvent;

    use \xiaodi\Permission\Traits\Role;
    use \app\traits\ValidateError;

    /**
     * a获取角色列表.
     */
    public function getList(int $page, int $pageSize)
    {
        $total = Role::count();
        $roles = Role::limit($pageSize)->page($page)->select();
        foreach ($roles as $role) {
            $role->permissions = $role->permissions()->select()->column('id');
        }

        return ['data' => $roles, 'pagination' => ['total' => $total, 'current' => intval($page), 'pageSize' => intval($pageSize)]];
    }

    /**
     * 添加角色.
     */
    public function addRole(array $data)
    {
        if ($this->validate('create', $data) === false) {
            return false;
        }

        $role = Role::create($data);

        // 绑定关系
        if (! empty($data['rules'])) {
            $role->assignPermissions($data['rules']);
        }
    }

    /**
     * 更新角色.
     */
    public function updateRole(int $id, array $data)
    {
        if ($this->validate('update', $data) === false) {
            return false;
        }

        $role = Role::find($id);
        if (empty($role)) {
            return false;
        }

        $role->save($data);

        // 解除关系
        $role->removeAllPermission();

        // 绑定关系
        if (! empty($data['rules'])) {
            $role->assignPermissions($data['rules']);
        }
    }

    /**
     * 删除角色.
     */
    public function deleteRole(int $id)
    {
        $role = $this->find($id);
        if (empty($role)) {
            return false;
        }

        $role->removeAllPermission();
        return $role->delete();
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
            validate(RoleValidate::class)
                ->scene($scene)
                ->check($data);
        } catch (ValidateException $e) {
            $this->error = $e->getError();
            return false;
        }

        return true;
    }

    /**
     * 绑定关系.
     */
    protected function assignPermissions(array $rules)
    {
        $rules = implode(',', $rules);
        $permissions = Permission::whereIn('id', $rules)->select();
        foreach ($permissions as $permission) {
            $this->assignPermission($permission);
        }
    }
}
