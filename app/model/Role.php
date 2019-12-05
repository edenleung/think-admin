<?php

namespace app\model;

use xiaodi\Permission\Contract\RoleContract;

class Role extends \think\Model implements RoleContract
{
    use \xiaodi\Permission\Traits\Role;

    public function getList($page, $pageSize)
    {
        $total = Role::count();
        $roles = Role::limit($pageSize)->page($page)->select();
        foreach ($roles as $role) {
            $role->permissions = $role->permissions()->select()->column('id');
        }

        return ['data' => $roles, 'pagination' => ['total' => $total, 'current' => intval($page), 'pageSize' => intval($pageSize)]];
    }

    public function add(array $data)
    {
        $role = Role::create($data);

        $permissions = Permission::whereIn('id', implode(',', $data['rules']))->select();
        foreach($permissions as $permission) {
            $role->assignPermission($permission);
        }
    }

    public function edit(int $id, array $data)
    {
        $role = Role::find($id);

        $role->save($data);

        $role->removeAllPermission();

        $permissions = Permission::whereIn('id', implode(',', $data['rules']))->select();
        foreach($permissions as $permission) {
            $role->assignPermission($permission);
        }
    }

    public function remove(int $id)
    {
        $role = Role::find($id);
        $role->removeAllPermission();
        $role->delete();
    }
}
