<?php
namespace app\admin\controller;

use app\service\model\rbac\RuleModel;
use app\service\model\rbac\GroupModel;
use app\service\model\rbac\GroupAccessModel;
use app\service\model\rbac\AdminModel;

class Rbac extends Base
{
    protected $ruleModel;
    protected $groupModel;
    protected $accessModel;
    protected $userModel;

    public function __construct()
    {
        parent::__construct();
        
        $this->ruleModel = new RuleModel();
        $this->groupModel = new GroupModel();
        $this->userModel = new AdminModel();
        $this->accessModel = new GroupAccessModel();
    }

    /**
     * 用户组列表
     *
     * @return void
     */
    public function groups($page = 1, $pageSize = 1)
    {
        $data = $this->groupModel->getList($page, $pageSize);

        $rules = $this->ruleModel->getList(1, 1000);

        return $this->sendSuccess(['roles' => $data, 'rules' => $rules]);
    }

    /**
     * 添加用户组
     *
     * @return void
     */
    public function addGroup()
    {
        try {
            $res = $this->groupModel->add($this->params);
        } catch (\Exception $e) {
            return $this->sendError($e->getMessage());
        }

        return $this->sendSuccess();
    }


    /**
     * 更新用户组
     *
     * @param integer $id 标识
     * @return void
     */
    public function updateGroup(int $id)
    {
        try {
            $res = $this->groupModel->edit($id, $this->params);
        } catch (\Exception $e) {
            return $this->sendError($e->getMessage());
        }

        return $this->sendSuccess();
    }

    /**
     * 删除用户组
     *
     * @param integer $id 标识
     * @return void
     */
    public function deleteGroup(int $id)
    {
        try {
            $res = $this->groupModel->deleteGroup($id);
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
    public function rules($page = 1, $pageSize = 3)
    {
        $res = $this->ruleModel->getList($page, $pageSize);
        return $this->sendSuccess($res);
    }

    public function _ajaxTree()
    {
        $res = $this->ruleModel->getTree();
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
            $res = $this->ruleModel->add($this->params);
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
            $res = $this->ruleModel->edit($id, $this->params);
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
            $res = $this->ruleModel->deleteRule($id);
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
            $res['users'] = $this->userModel->getList($page, $pageSize);
            $res['rules'] = $this->ruleModel->getList(1, 1000);
            $res['roles'] = $this->groupModel->getList(1, 1000);
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
            $res = $this->userModel->addUser($this->params);
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
            $res = $this->userModel->updateUser($id, $this->params);
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
            $res = $this->userModel->deleteUser($id);
        } catch (\Exception $e) {
            return $this->sendError($e->getMessage());
        }

        return $this->sendSuccess();
    }
}
