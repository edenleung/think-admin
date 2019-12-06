<?php

namespace app\controller;

use app\model\Permission;
use app\model\Role as Model;

class Role extends AbstractController
{
    protected $model;

    public function __construct(Model $model)
    {
        $this->model = $model;
    }

    /**
     * 角色列表
     *
     * @return void
     */
    public function list($page = 1, $pageSize = 1, Permission $permission)
    {
        $data = $this->model->getList($page, $pageSize);
        $rules = $permission->getList(1, 10000);
        return $this->sendSuccess(['roles' => $data, 'rules' => $rules]);
    }

    /**
     * 添加角色
     *
     * @return void
     */
    public function add()
    {
        $this->model->addRule($this->request->param());

        return $this->sendSuccess();
    }

    /**
     * 更新角色
     *
     * @param integer $id 标识
     * @return void
     */
    public function update(int $id)
    {
        $this->model->updateRole($id, $this->request->param());

        return $this->sendSuccess();
    }

    /**
     * 删除角色
     *
     * @param integer $id 标识
     * @return void
     */
    public function delete(int $id)
    {
        $this->model->deleteRole($id);

        return $this->sendSuccess();
    }
}
