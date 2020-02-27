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

namespace app\service;

use app\BaseService;
use app\model\Permission;
use app\model\Role;
use app\model\User;

class RoleService extends BaseService
{
    public function __construct(Role $role)
    {
        $this->model = $role;
    }

    /**
     * 获取角色列表.
     */
    public function getList(int $pageNo, int $pageSize)
    {
        $map = [];
        $user = request()->user;
        $category = new \Tant\Util\Category();

        // 不是超级管理员，只显示当前用户所属角色的所有下级角色
        if ($user->isSuper() === false) {
            $childrenRoleIds = $this->getChildrenRoleIds($user);

            if (! empty($childrenRoleIds)) {
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
            'totalCount' => $total,
        ];
    }

    /**
     * 添加角色.
     *
     * @return bool
     */
    public function add(array $data)
    {
        $this->model->save($data);

        // 绑定关系
        if (! empty($data['rules'])) {
            $this->assignPermissions($this->model, $data['rules']);
        }

        return true;
    }

    /**
     * 更新角色.
     *
     * @param int $id
     * @return bool
     */
    public function renew($id, array $input)
    {
        $role = $this->model->find($id);
        if (empty($role)) {
            return false;
        }

        $role->save($input);

        // 解除关系
        $role->removeAllPermission();

        // 绑定关系
        if (! empty($input['rules'])) {
            $this->assignPermissions($role, $input['rules']);

            // 如当前角色有删除一些权限并且有子角色时，子角色也一并删除权限
            $this->updateChildrenRole($role, $input['rules']);
        }

        return true;
    }

    /**
     * 删除角色.
     *
     * @param mixed $id
     * @return bool
     */
    public function remove($id)
    {
        $role = $this->find($id);
        if (empty($role)) {
            return false;
        }

        if ($this->hasChildrenRole($role)) {
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

    public function getSelectTree()
    {
        $map = [];
        $user = request()->user;
        $category = new \Tant\Util\Category();

        // 不是超级管理员，只显示当前用户所属角色的所有下级角色
        if ($user->isSuper() === false) {
            $childrenRoleIds = $this->getChildrenRoleIds($user);

            if (! empty($childrenRoleIds)) {
                $map[] = ['id', 'in', $childrenRoleIds];
            }
        }

        $data = Role::where($map)->select()->toArray();
        $tree = $category->formatTree($data);
        $tree[0]['selectable'] = $user->isSuper();
        return $tree;
    }

    /**
     * 获取下拉选择数据.
     *
     * @return \think\Collection
     */
    public function getSelectData()
    {
        $user = request()->user;

        $map = [];
        // 不是超级管理员，只显示当前用户所属角色的所有下级角色
        if ($user->isSuper() === false) {
            $childrenRoleIds = $this->getChildrenRoleIds($user);

            if (! empty($childrenRoleIds)) {
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
     * 获取当前角色的所有子角色.
     *
     * @return \think\Collection
     */
    public function childrenRole(Role $role)
    {
        $roles = Role::select();
        $category = new \Tant\Util\Category();
        return $category->getTree($roles, $role->id);
    }

    /**
     * 当前角色是否存在子角色.
     *
     * @return bool
     */
    public function hasChildrenRole(Role $role)
    {
        $roles = $this->model->select();

        $category = new \Tant\Util\Category();
        $children = $category->getChild($role->id, $roles);

        return ! empty($children);
    }

    /**
     * 角色与规则绑定关系.
     */
    public function assignPermissions(Role $role, array $rules)
    {
        $rules = implode(',', $rules);
        $permissions = Permission::whereIn('id', $rules)->select();

        foreach ($permissions as $permission) {
            $role->assignPermission($permission);
        }
    }

    /**
     * 更新角色数据权限.
     *
     * @param [type] $id
     * @param [type] $data
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
            if (! empty($depts)) {
                $role->depts()->attach($depts);
            }
        }

        $role->save();
    }

    /**
     * 获取当前用户下所有子角色id.
     *
     * @return array
     */
    protected function getChildrenRoleIds(User $user)
    {
        $ids = [];
        $category = new \Tant\Util\Category();

        $all = $this->model->order('pid asc')->select()->toArray();

        foreach ($user->roles as $role) {
            $roles = array_column($category->getTree($all, $role->id), 'id');
            if (! empty($roles)) {
                $ids = array_merge($ids, $roles);
            }
        }

        return $ids;
    }

    /**
     * 更新子角色权限.
     */
    protected function updateChildrenRole(Role $role, array $rules)
    {
        // 对比差异 获取子角色要删除的权限
        $delete_rules = array_diff($role->permissions->column('id'), $rules);

        if (! empty($delete_rules)) {
            $permissions = Permission::whereIn('id', $delete_rules)->select();

            $roles = $this->childrenRole($role);
            foreach ($roles as $role) {
                foreach ($permissions as $permission) {
                    $role->removePermission($permission);
                }
            }
        }
    }
}
