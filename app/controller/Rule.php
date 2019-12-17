<?php

declare(strict_types=1);
/**
 * This file is part of ThinkPHP.
 * @link     https://github.com/xiaodit/think-admin
 * @document https://www.kancloud.cn/manual/thinkphp6_0
 * @contact  group@thinkphp.cn
 * @author   XiaoDi 758861884@qq.com
 * @copyright 2019 Xiaodi
 * @license  https://github.com/xiaodit/think-admin/blob/6.0/LICENSE.txt
 */

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
     * 规则列表.
     *
     * @param mixed $page
     * @param mixed $pageSize
     */
    public function list($page = 1, $pageSize = 1)
    {
        $data = $this->model->getList((int)$page, (int)$pageSize);
        return $this->sendSuccess($data);
    }

    /**
     * 添加规则.
     */
    public function add()
    {
        if (! $this->model->addRule($this->request->param())) {
            return $this->sendError($this->model->getError());
        }

        return $this->sendSuccess();
    }

    /**
     * 更新规则.
     *
     * @param int $id 标识
     */
    public function update(int $id)
    {
        if (! $this->model->updateRule($id, $this->request->param())) {
            return $this->sendError($this->model->getError());
        }

        return $this->sendSuccess();
    }

    /**
     * 删除规则.
     *
     * @param int $id 标识
     */
    public function delete(int $id)
    {
        if ($this->model->deleteRule($id) === false) {
            return $this->sendError($this->model->getError());
        }

        return $this->sendSuccess();
    }
}
