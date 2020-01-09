<?php

namespace app\admin\controller\system;

use app\AbstractController;

class Dept extends AbstractController
{
    public function __construct(\app\model\Dept $dept)
    {
        parent::__construct();
        $this->model = $dept;
    }

    public function list()
    {
        $data = $this->model->getTree();
        return $this->sendSuccess([
            'data' => $data,
            'pageSize' => 10,
            'pageNo' => 1,
            'totalPage' => 1,
            'totalCount' => count($data)
        ]);
    }

    public function add()
    {
        if (! $this->model->addDept($this->request->param())) {
            return $this->sendError($this->model->getError());
        }

        return $this->sendSuccess();
    }

    public function update(int $id)
    {
        if (! $this->model->updateDept($id, $this->request->param())) {
            return $this->sendError($this->model->getError());
        }

        return $this->sendSuccess();
    }

    public function delete(int $id)
    {
        if ($this->model->deleteDept($id) === false) {
            return $this->sendError($this->model->getError());
        }

        return $this->sendSuccess();
    }
}
