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

namespace app\admin\controller;

use app\AbstractController;
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
     * 角色列表.
     *
     * @param mixed $page
     * @param mixed $pageSize
     */
    public function list($page = 1, $pageSize = 1, Permission $permission)
    {
        $data = $this->model->getList((int) $page, (int) $pageSize);
        $rules = $permission->getList(1, 10000);
        return $this->sendSuccess(['roles' => $data, 'rules' => $rules]);
    }

    /**
     * 添加角色.
     */
    public function add()
    {
        if ($this->model->addRole($this->request->param()) === false) {
            return $this->sendError($this->model->getError());
        }

        return $this->sendSuccess();
    }

    /**
     * 更新角色.
     *
     * @param int $id 标识
     */
    public function update(int $id)
    {
        if ($this->model->updateRole($id, $this->request->param()) === false) {
            return $this->sendError($this->model->getError());
        }

        return $this->sendSuccess();
    }

    /**
     * 删除角色.
     *
     * @param int $id 标识
     */
    public function delete(int $id)
    {
        if ($this->model->deleteRole($id) === false) {
            return $this->sendError($this->model->getError());
        }

        return $this->sendSuccess();
    }
}
