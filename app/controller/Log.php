<?php

declare(strict_types=1);

namespace app\controller;

use app\model\Log as Model;

class Log extends AbstractController
{
    protected $model;

    public function __construct(Model $model)
    {
        $this->model = $model;
    }

    /**
     * 日志列表
     *
     * @return void
     */
    public function list($page = 1, $pageSize = 10)
    {
        $data = $this->model->getList($page, $pageSize);
        return $this->sendSuccess($data);
    }

    /**
     * 删除日志
     *
     * @param string $id
     * @return void
     */
    public function delete($id)
    {
        if (false === $this->model->deleteLog($id)) {
            return $this->sendError($this->model->getError());
        }

        return $this->sendSuccess();
    }
}
