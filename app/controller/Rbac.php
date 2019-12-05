<?php

namespace app\controller;

use app\model\Permission;
use app\model\Role;
use app\model\User;

class Rbac extends AbstractController
{
    /**
     * 角色列表
     *
     * @return void
     */
    public function roles($page = 1, $pageSize = 1, Role $role, Permission $permission)
    {
        $data = $role->getList($page, $pageSize);
        $rules = $permission->getList(1, 10000);
        return $this->sendSuccess(['roles' => $data, 'rules' => $rules]);
    }

    /**
     * 添加角色
     *
     * @return void
     */
    public function addRole(Role $role)
    {
        $role->add($this->request->param());

        return $this->sendSuccess();
    }

    /**
     * 更新角色
     *
     * @param integer $id 标识
     * @return void
     */
    public function updateRole(int $id, Role $role)
    {
        $role->edit($id, $this->request->param());

        return $this->sendSuccess();
    }

    /**
     * 删除角色
     *
     * @param integer $id 标识
     * @return void
     */
    public function deleteRole(int $id, Role $role)
    {
        $role->remove($id);
        return $this->sendSuccess();
    }

    /**
     * 规则列表
     *
     * @return void
     */
    public function rules($page = 1, $pageSize = 1, Permission $permission)
    {
        $data = $permission->getList($page, $pageSize);
        return $this->sendSuccess($data);
    }

    /**
     * 添加规则
     *
     * @return void
     */
    public function addRule(Permission $permission)
    {
        if (!$permission->add($this->request->param()))
        {
            return $this->sendError();
        }

        return $this->sendSuccess();
    }

    /**
     * 更新规则
     *
     * @param integer $id 标识
     * @return void
     */
    public function updateRule(int $id, Permission $permission)
    {
        if (!$permission->edit($id, $this->request->param()))
        {
            return $this->sendError();
        }
        
        return $this->sendSuccess();
    }

    /**
     * 删除规则
     *
     * @param integer $id 标识
     * @return void
     */
    public function deleteRule(int $id, Permission $permission)
    {
        $permission->remove($id);
        return $this->sendSuccess();
    }

    /**
     * 用户列表
     *
     * @return void
     */
    public function users($page = 1, $pageSize = 1, User $user, Permission $permission, Role $role)
    {
        $res['users'] = $user->getList($page, $pageSize);

        $res['rules'] = $permission->getList(1, 1000);
        $res['roles'] = $role->getList(1, 1000);
        return $this->sendSuccess($res);

    }

    /**
     * 添加用户
     *
     * @return void
     */
    public function addUser(User $user)
    {
        $user->addUser($this->request->param());
        return $this->sendSuccess();
    }

    /**
     * 更新用户
     *
     * @param integer $id 标识
     * @return void
     */
    public function updateUser(int $id, User $user)
    {
        $user->updateUser($id, $this->request->param());
        return $this->sendSuccess();
    }

    /**
     * 删除用户
     *
     * @param integer $id 标识
     * @return void
     */
    public function deleteUser(int $id, User $user)
    {
        $user->deleteUser($id);
        return $this->sendSuccess();
    }
}
