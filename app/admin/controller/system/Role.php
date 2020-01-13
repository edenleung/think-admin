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
use app\model\Permission;
use app\model\Role as Model;
use app\model\Dept;

class Role extends AbstractController
{
    protected $model;

    public function __construct(Model $model)
    {
        parent::__construct();
        $this->model = $model;
    }

    /**
     * 角色列表.
     *
     * @param mixed $pageNo
     * @param mixed $pageSize
     */
    public function list($pageNo = 1, $pageSize = 10)
    {
        $data = $this->model->getList((int) $pageNo, (int) $pageSize);
        $rules = (new Permission)->getMenuPermission();
        $depts = (new Dept)->getTree();
        return $this->sendSuccess(['roles' => $data, 'rules' => $rules, 'depts' => $depts]);
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

    public function mode(int $id)
    {
        if ($this->model->updateMode($id, $this->request->param()) === false) {
            return $this->sendError($this->model->getError());
        }

        return $this->sendSuccess();
    }


}
