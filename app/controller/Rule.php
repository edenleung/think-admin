<?php

namespace app\controller;

use app\model\Permission as Model;

class Rule extends AbstractController
{
    protected $model;

    public function __construct(Model $model)
    {
        $this->model = $model;
    }

    /**
     * 规则列表
     *
     * @return void
     */
    public function list($page = 1, $pageSize = 1)
    {
        $data = $this->model->getList($page, $pageSize);
        return $this->sendSuccess($data);
    }

    /**
     * 添加规则
     *
     * @return void
     */
    public function add()
    {
        if (!$this->model->addRule($this->request->param())) {
            return $this->sendError($this->model->getError());
        }

        return $this->sendSuccess();
    }

    /**
     * 更新规则
     *
     * @param integer $id 标识
     * @return void
     */
    public function update(int $id)
    {
        if (!$this->model->updateRule($id, $this->request->param())) {
            return $this->sendError($this->model->getError());
        }

        return $this->sendSuccess();
    }

    /**
     * 删除规则
     *
     * @param integer $id 标识
     * @return void
     */
    public function delete(int $id)
    {
        if (false === $this->model->deleteRule($id))
        {
            return $this->sendError($this->model->getError());
        }

        return $this->sendSuccess();
    }
}
