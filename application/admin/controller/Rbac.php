<?php
namespace app\admin\controller;

use app\Permission\Models\User;
use app\Permission\Models\Permission;
use app\Permission\Models\Role;
use app\Permission\Models\RoleAccess;

class Rbac extends Base
{
    protected $rule;
    protected $role;
    protected $access;
    protected $user;

    public function __construct()
    {
        parent::__construct();
        
        $this->rule = new Permission();
        $this->role = new Role();
        $this->user = new User();
        // $this->access = new RoleAccess();
    }

    /**
     * 角色列表
     *
     * @return void
     */
    public function roles($page = 1, $pageSize = 1)
    {
        $data = $this->role->getList($page, $pageSize);

        $rules = $this->rule->getList(1, 1000);

        return $this->sendSuccess(['roles' => $data, 'rules' => $rules]);
    }

    /**
     * 添加角色
     *
     * @return void
     */
    public function addRole()
    {
        try {
            $res = $this->role->add($this->params);
        } catch (\Exception $e) {
            return $this->sendError($e->getMessage());
        }

        return $this->sendSuccess();
    }


    /**
     * 更新角色
     *
     * @param integer $id 标识
     * @return void
     */
    public function updateRole(int $id)
    {
        try {
            $res = $this->role->edit($id, $this->params);
        } catch (\Exception $e) {
            return $this->sendError($e->getMessage());
        }

        return $this->sendSuccess();
    }

    /**
     * 删除角色
     *
     * @param integer $id 标识
     * @return void
     */
    public function deleteRole(int $id)
    {
        try {
            $res = $this->role->deleteRole($id);
        } catch (\Exception $e) {
            return $this->sendError($e->getMessage());
        }

        return $this->sendSuccess();
    }

    /**
     * 规则列表
     *
     * @return void
     */
    public function rules($page = 1, $pageSize = 1)
    {
        $res = $this->rule->getList($page, $pageSize);
        return $this->sendSuccess($res);
    }

    public function _ajaxTree()
    {
        $res = $this->rule->getTree();
        return $this->sendSuccess($res);
    }


    /**
     * 添加规则
     *
     * @return void
     */
    public function addRule()
    {
        try {
            $res = $this->rule->add($this->params);
        } catch (\Exception $e) {
            return $this->sendError($e->getMessage());
        }

        return $this->sendSuccess();
    }


    /**
     * 更新规则
     *
     * @param integer $id 标识
     * @return void
     */
    public function updateRule(int $id)
    {
        try {
            $res = $this->rule->edit($id, $this->params);
        } catch (\Exception $e) {
            return $this->sendError($e->getMessage());
        }

        return $this->sendSuccess();
    }

    /**
     * 删除规则
     *
     * @param integer $id 标识
     * @return void
     */
    public function deleteRule(int $id)
    {
        try {
            $res = $this->rule->deleteRule($id);
        } catch (\Exception $e) {
            return $this->sendError($e->getMessage());
        }

        return $this->sendSuccess();
    }

    /**
     * 用户列表
     *
     * @return void
     */
    public function users($page = 1, $pageSize = 1)
    {
        try {
            $res['users'] = $this->user->getList($page, $pageSize);
            $res['rules'] = $this->rule->getList(1, 1000);
            $res['roles'] = $this->role->getList(1, 1000);
        } catch (\Exception $e) {
            return $this->sendError($e->getMessage());
        }

        
        return $this->sendSuccess($res);
    }

    /**
     * 添加用户
     *
     * @return void
     */
    public function addUser()
    {
        try {
            $res = $this->user->addUser($this->params);
        } catch (\Exception $e) {
            return $this->sendError($e->getMessage());
        }

        return $this->sendSuccess();
    }

    /**
     * 更新用户
     *
     * @param integer $id 标识
     * @return void
     */
    public function updateUser(int $id)
    {
        try {
            $res = $this->user->updateUser($id, $this->params);
        } catch (\Exception $e) {
            return $this->sendError($e->getMessage());
        }

        return $this->sendSuccess();
    }

    /**
     * 删除用户
     *
     * @param integer $id 标识
     * @return void
     */
    public function deleteUser(int $id)
    {
        try {
            $res = $this->user->deleteUser($id);
        } catch (\Exception $e) {
            return $this->sendError($e->getMessage());
        }

        return $this->sendSuccess();
    }
}
