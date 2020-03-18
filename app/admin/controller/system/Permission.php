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
use app\admin\request\PermissionRequest;
use app\admin\service\PermissionService;

class Permission extends BaseController
{
    public function __construct(PermissionService $service)
    {
        $this->service = $service;
    }

    /**
     * 规则列表.
     *
     * @param [type] $pageSize
     * @param [type] $pageNo
     *
     * @return \think\Response
     */
    public function list($pageSize, $pageNo)
    {
        $result = $this->service->list((int) $pageNo, (int) $pageSize);

        return $this->sendSuccess($result);
    }

    /**
     * 添加规则.
     *
     * @return \think\Response
     */
    public function add(PermissionRequest $request)
    {
        if (!$request->scene('create')->validate()) {
            return $this->sendError($request->getError());
        }

        if ($this->service->add($request->param()) === false) {
            return $this->sendError();
        }

        return $this->sendSuccess();
    }

    /**
     * 更新规则.
     *
     * @param [type] $id
     *
     * @return \think\Response
     */
    public function renew($id, PermissionRequest $request)
    {
        if (!$request->scene('update')->validate()) {
            return $this->sendError($request->getError());
        }

        if ($this->service->renew($id, $request->param()) === false) {
            return $this->sendError();
        }

        return $this->sendSuccess();
    }

    /**
     * 删除规则.
     *
     * @param [type] $id
     *
     * @return \think\Response
     */
    public function remove($id)
    {
        if ($this->service->remove($id) === false) {
            return $this->sendError();
        }

        return $this->sendSuccess();
    }
}
