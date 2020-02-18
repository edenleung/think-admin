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

use app\admin\request\DeptRequest;
use app\BaseController;
use app\service\DeptService;

class Dept extends BaseController
{
    public function __construct(DeptService $service)
    {
        parent::__construct();
        $this->service = $service;
    }

    /**
     * 部门列表.
     * @return \think\Response
     */
    public function list()
    {
        $data = $this->service->getTree();
        return $this->sendSuccess([
            'data' => $data,
            'pageSize' => 10,
            'pageNo' => 1,
            'totalPage' => 1,
            'totalCount' => count($data),
        ]);
    }

    /**
     * 添加部门.
     * @return \think\Response
     */
    public function add(DeptRequest $request)
    {
        $request->validate();

        if (! $this->service->add($request->param())) {
            return $this->sendError($this->service->getError());
        }

        return $this->sendSuccess();
    }

    /**
     * 更新部门.
     *
     * @param [type] $id
     * @return \think\Response
     */
    public function update($id, DeptRequest $request)
    {
        $request->validate();

        if (! $this->service->renew($id, $request->param())) {
            return $this->sendError($this->service->getError());
        }

        return $this->sendSuccess();
    }

    /**
     * 删除部门.
     *
     * @param [type] $id
     * @return \think\Response
     */
    public function delete($id)
    {
        if ($this->service->remove($id) === false) {
            return $this->sendError($this->service->getError());
        }

        return $this->sendSuccess();
    }
}
