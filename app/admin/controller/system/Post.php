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
use app\admin\request\PostRequest;
use app\admin\service\PostService;

class Post extends BaseController
{
    public function __construct(PostService $service)
    {
        parent::__construct();
        $this->service = $service;
    }

    /**
     * 岗位列表.
     *
     * @return \think\Response
     */
    public function all()
    {
        $data = $this->service->all();

        return $this->sendSuccess($data);
    }

    /**
     * 添加岗位.
     *
     * @return \think\Response
     */
    public function create(PostRequest $request)
    {
        if (!$request->scene('create')->validate()) {
            return $this->sendError($request->getError());
        }

        if ($this->service->create($request->post()) === false) {
            return $this->sendError();
        }

        return $this->sendSuccess();
    }

    /**
     * 更新岗位.
     *
     * @param [type] $id
     *
     * @return \think\Response
     */
    public function update($id, PostRequest $request)
    {
        if (!$request->scene('update')->validate()) {
            return $this->sendError($request->getError());
        }

        if ($this->service->update($id, $request->put()) === false) {
            return $this->sendError();
        }

        return $this->sendSuccess();
    }

    /**
     * 删除岗位.
     *
     * @param [type] $id
     *
     * @return \think\Response
     */
    public function delete($id)
    {
        if ($this->service->delete($id) === false) {
            return $this->sendError();
        }

        return $this->sendSuccess();
    }
}
