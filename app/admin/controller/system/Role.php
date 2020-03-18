<?php

declare(strict_types=1);

/*
 * This file is part of TAnt.
 * @link     https://github.com/edenleung/think-admin
 * @document https://www.kancloud.cn/manual/thinkphp6_0
 * @contact  QQ Group 996887666
 * @author   Eden Leung 758861884@qq.com
 * @copyright 2019 Eden Leung
 * @license  https://github.com/edenleung/think-admin/blob/6.0/LICENSE.txt
 */

namespace app\admin\controller\system;

use app\BaseController;
use app\admin\request\RoleRequest;
use app\admin\service\DeptService;
use app\admin\service\RoleService;
use app\admin\service\PermissionService;

class Role extends BaseController
{
    protected $permission;

    protected $dept;

    public function __construct(RoleService $service, PermissionService $permission, DeptService $dept)
    {
        parent::__construct();

        $this->service = $service;
        $this->permission = $permission;
        $this->dept = $dept;
    }

    /**
     * 角色列表.
     *
     * @param mixed $pageNo
     * @param mixed $pageSize
     *
     * @return \think\Response
     */
    public function list($pageNo = 1, $pageSize = 10)
    {
        $data = $this->service->getList((int) $pageNo, (int) $pageSize);
        $rules = $this->permission->getMenuPermission();
        $depts = $this->dept->getTree();
        $menu = $this->permission->getTree();

        return $this->sendSuccess(['roles' => $data, 'rules' => $rules, 'depts' => $depts, 'menu' => $menu]);
    }

    /**
     * 添加角色.
     *
     * @return \think\Response
     */
    public function add(RoleRequest $request)
    {
        if (!$request->scene('create')->validate()) {
            return $this->sendError($request->getError());
        }

        if ($this->service->add($request->param()) === false) {
            return $this->sendError($this->service->getError());
        }

        return $this->sendSuccess();
    }

    /**
     * 更新角色.
     *
     * @param [type] $id
     *
     * @return \think\Response
     */
    public function update($id, RoleRequest $request)
    {
        if (!$request->scene('update')->validate()) {
            return $this->sendError($request->getError());
        }

        if ($this->service->renew($id, $request->param()) === false) {
            return $this->sendError($this->service->getError());
        }

        return $this->sendSuccess();
    }

    /**
     * 删除角色.
     *
     * @param [type] $id
     *
     * @return \think\Response
     */
    public function delete($id)
    {
        if ($this->service->remove($id) === false) {
            return $this->sendError($this->service->getError());
        }

        return $this->sendSuccess();
    }

    /**
     * 更新角色数据权限.
     *
     * @param [type] $id
     *
     * @return \think\Response
     */
    public function mode($id)
    {
        $params = $this->request->param();
        if ($this->service->updateMode($id, $params) === false) {
            return $this->sendError($this->service->getError());
        }

        return $this->sendSuccess();
    }
}
