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

namespace app\admin\controller\system;

use app\AbstractController;
use app\model\Permission as Model;

class Permission extends AbstractController
{
    protected $model;

    public function __construct(Model $model)
    {
        parent::__construct();
        $this->model = $model;
    }

    /**
     * 规则列表.
     *
     * @param mixed $pageNo
     * @param mixed $pageSize
     */
    public function list($pageNo = 1, $pageSize = 100)
    {
        $data = $this->model->getList((int) $pageNo, (int) $pageSize);
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
