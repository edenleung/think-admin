<?php

namespace app\model;

use xiaodi\Permission\Contract\RoleContract;
use app\model\validate\RoleValidate;
use think\exception\ValidateException;

class Role extends \think\Model implements RoleContract
{
    use \xiaodi\Permission\Traits\Role, \app\traits\ValidateError;

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
            validate(RoleValidate::class)
                ->scene($scene)
                ->check($data);
        } catch (ValidateException $e) {
            $this->error = $e->getError();
            return false;
        }

        return true;
    }

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
     * 添加角色
     *
     * @param array $data
     * @return void
     */
    public function addRole(array $data)
    {
        if (false === $this->validate('create', $data)) {
            return false;
        }

        $role = Role::create($data);

        // 绑定关系
        if (!empty($data['rules'])) {
            $role->assignPermissions($data['rules']);
        }
    }

    /**
     * 更新角色
     *
     * @param integer $id
     * @param array $data
     * @return void
     */
    public function updateRole(int $id, array $data)
    {
        if (false === $this->validate('update', $data)) {
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
        if (!empty($data['rules'])) {
            $role->assignPermissions($data['rules']);
        }
    }

    /**
     * 删除角色
     *
     * @param integer $id
     * @return void
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
     * 绑定关系
     *
     * @param array $rules
     * @return void
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
