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
    public function groups()
    {
        $data = $this->groupModel->select();

        $rules = $this->ruleModel->getList();

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
    public function rules()
    {
        $res = $this->ruleModel->getList();
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
    public function users()
    {
        try {
            $subsql = $this->accessModel->group('uid')->field('uid, GROUP_CONCAT(group_id) as groups')->buildSql();

            $keyword = empty($this->params['keyword']) ? '' : $this->params['keyword'];
            $users = $this->userModel->alias('A')
                ->where(function($query) use($keyword) {
                    if ($keyword) {
                        $query->where('A.admin_nickname', 'like', $keyword . '%');
                    }
                })
                ->where('A.admin_id', '<>', config('auth.auth_super_id'))
                ->leftjoin([$subsql => 'G'], ' G.uid = A.admin_id')
                ->field('A.*,G.groups, (SELECT GROUP_CONCAT(rules) as rules FROM pg_auth_group WHERE id  in (G.groups)) as rules')
                ->select();

            foreach($users as $key=>$user) {
                $users[$key]['rules'] = array_unique(explode(',', $user['rules']));
            }
          
        } catch (\Exception $e) {
            return $this->sendError($e->getMessage());
        }

        return $this->sendSuccess($users);
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
