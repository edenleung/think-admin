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
use app\admin\request\DeptRequest;
use app\admin\service\DeptService;

class Dept extends BaseController
{
    public function __construct(DeptService $service)
    {
        parent::__construct();
        $this->service = $service;
    }

    /**
     * 部门列表.
     *
     * @return \think\Response
     */
    public function list()
    {
        $data = $this->service->getTree();

        return $this->sendSuccess($data);
    }

    /**
     * 添加部门.
     *
     * @return \think\Response
     */
    public function create(DeptRequest $request)
    {
        if (!$request->validate()) {
            return $this->sendError($request->getError());
        }

        if (!$this->service->create($request->param())) {
            return $this->sendError($this->service->getError());
        }

        return $this->sendSuccess();
    }

    /**
     * 更新部门.
     *
     * @param [type] $id
     *
     * @return \think\Response
     */
    public function update($id, DeptRequest $request)
    {
        if (!$request->validate()) {
            return $this->sendError($request->getError());
        }

        if (!$this->service->update($id, $request->param())) {
            return $this->sendError($this->service->getError());
        }

        return $this->sendSuccess();
    }

    /**
     * 删除部门.
     *
     * @param [type] $id
     *
     * @return \think\Response
     */
    public function delete($id)
    {
        if ($this->service->delete($id) === false) {
            return $this->sendError($this->service->getError());
        }

        return $this->sendSuccess();
    }
}
