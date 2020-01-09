<?php

declare(strict_types=1);
/**
 * This file is part of TAnt.
 * @link     https://github.com/edenleung/think-admin
 * @document https://www.kancloud.cn/manual/thinkphp6_0
 * @contact  QQ Group 996887666
 * @author   Eden Leung 758861884@qq.com
 * @copyright 2019 Eden Leung
 * @license  https://github.com/edenleung/think-admin/blob/6.0/LICENSE.txt
 */

namespace app\model;

use app\model\validate\RoleValidate;
use think\exception\ValidateException;
use xiaodi\Permission\Contract\RoleContract;
use think\model\relation\BelongsToMany;

class Role extends \xiaodi\Permission\Model\Role implements RoleContract
{
    use \app\traits\CurdEvent;
    use \app\traits\ValidateError;

    use \xiaodi\Permission\Traits\Role;

    /**
     * 获取角色下部门.
     *
     * @return BelongsToMany
     */
    public function depts(): BelongsToMany
    {
        return $this->belongsToMany(
            Dept::class,
            RoleDeptAccess::class,
            'dept_id',
            'role_id'
        );
    }

    /**
     * 获取角色列表.
     */
    public function getList(int $pageNo, int $pageSize)
    {
        $map = [];
        $user = request()->user;
        $category = new \extend\Category();

        // 不是超级管理员，只显示当前用户所属角色的所有下级角色
        if (false === $user->isSuper()) {
            $childrenRoleIds = $this->getChildrenRoleIds($user);

            if (!empty($childrenRoleIds)) {
                $map[] = ['id', 'in', $childrenRoleIds];
            }
        }

        $map[] = ['id', '<>', 1];
        $total = Role::where($map)->count();

        $roles = Role::where($map)->limit($pageSize)->page($pageNo)->select();
        foreach ($roles as $role) {
            $role->permissions = $role->permissions()->select()->column('id');
            $role->deptIds = $role->depts()->select()->column('dept_id');
        }

        $data = $roles->toArray();
        $roles = $category->getTree($data);

        $tree = $this->getSelectTree();
        return [
            'data' => $data,
            'tree' => $tree,
            'pageSize' => $pageSize,
            'pageNo' => $pageNo,
            // 'totalPage' => count($roles),
            'totalCount' => $total
        ];
    }

    public function getSelectTree()
    {
        $map = [];
        $user = request()->user;
        $category = new \extend\Category();

        // 不是超级管理员，只显示当前用户所属角色的所有下级角色
        if (false === $user->isSuper()) {
            $childrenRoleIds = $this->getChildrenRoleIds($user);

            if (!empty($childrenRoleIds)) {
                $map[] = ['id', 'in', $childrenRoleIds];
            }
        }

        $data = Role::where($map)->select()->toArray();
        $tree = $category->formatTree($data);
        $tree[0]['selectable'] = $user->isSuper();
        return $tree;
    }

    /**
     * 获取下拉选择数据
     *
     * @return \think\Collection
     */
    public function getSelectData()
    {
        $user = request()->user;

        $map = [];
        // 不是超级管理员，只显示当前用户所属角色的所有下级角色
        if (false === $user->isSuper()) {
            $childrenRoleIds = $this->getChildrenRoleIds($user);

            if (!empty($childrenRoleIds)) {
                $map[] = ['id', 'in', $childrenRoleIds];
            }
        }

        $roles = Role::where($map)->select();
        foreach ($roles as $role) {
            $role->permissions = $role->permissions()->select()->column('id');
        }

        return $roles;
    }

    /**
     * 获取当前用户下所有子角色id
     *
     * @param User $user
     * @return array
     */
    protected function getChildrenRoleIds(User $user)
    {
        $ids = [];
        $category = new \extend\Category();

        $all = $this->order('pid asc')->select()->toArray();

        foreach($user->roles as $role) {
            $roles = array_column($category->getTree($all, $role->id), 'id');
            if (!empty($roles)) {
                $ids = array_merge($ids, $roles);
            }
        }

        return $ids;
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

            // 如当前角色有删除一些权限并且有子角色时，子角色也一并删除权限
            $role->updateChildrenRole($data['rules']);
        }
    }

    /**
     * 更新子角色权限
     *
     * @param array $rules
     */
    protected function updateChildrenRole(array $rules)
    {
        // 对比差异 获取子角色要删除的权限
        $delete_rules = array_diff($this->permissions->column('id'), $rules);

        if (!empty($delete_rules)) {
            $permissions = Permission::whereIn('id', $delete_rules)->select();

            $roles = $this->childrenRole();
            foreach($roles as $role) {
                foreach($permissions as $permission) {
                    $role->removePermission($permission);
                }
            }
        }
    }

    /**
     * 获取当前角色的所有子角色
     *
     * @return \think\Collection
     */
    protected function childrenRole()
    {
        $roles = Role::select();
        $category = new \extend\Category();
        $children = $category->getTree($roles, $this->id);

        return $children;
    }

    /**
     * 当前角色是否存在子角色
     *
     * @return boolean
     */
    protected function hasChildrenRole()
    {
        $roles = Role::select();

        $category = new \extend\Category();
        $children = $category->getChild($this->id, $roles);

        return !empty($children);
    }

    /**
     * 删除角色.
     *
     * @return boolean
     */
    public function deleteRole(int $id)
    {
        $role = $this->find($id);
        if (empty($role)) {
            return false;
        }

        if ($role->hasChildrenRole()) {
            $this->error = '请先删除子角色';
            return false;
        }

        if (count($role->users) > 0) {
            $this->error = '当前角色下存在使用中的用户，请为用户更换其它角色后，再执行删除操作';
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

    /**
     * 更新角色数据权限
     *
     * @param [type] $id
     * @param [type] $data
     * @return void
     */
    public function updateMode($id, $data)
    {
        $role = $this->find($id);
        $mode = $data['mode'];

        $role->mode = $mode;
        $role->depts()->detach();

        // 自定义数据权限
        if ($mode === 2) {
            $depts = $data['deptIds'];
            if (!empty($depts)) {
                $role->depts()->attach($depts);
            }
        }

        $role->save();
    }
}
