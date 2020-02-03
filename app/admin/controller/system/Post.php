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

use app\BaseController;
use app\service\PostService;
use think\exception\ValidateException;

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
    public function list()
    {
        $data = $this->service->getList();
        return $this->sendSuccess($data);
    }

    /**
     * 添加岗位.
     *
     * @return \think\Response
     */
    public function add()
    {
        $data = $this->request->param();

        try {
            $this->validate($data, [
                'postName' => 'require',
                'postCode' => 'require|unique:post',
            ], [
                'postName.require' => '名称必须',
                'postCode.require' => '标识必须',
                'postCode.unique' => '标识重复',
            ]);
        } catch (ValidateException $e) {
            return $this->sendError($e->getError());
        }

        if ($this->service->add($data) === false) {
            return $this->sendError();
        }

        return $this->sendSuccess();
    }

    /**
     * 更新岗位.
     *
     * @param [type] $id
     * @return \think\Response
     */
    public function renew($id)
    {
        $data = $this->request->param();

        try {
            $this->validate($data, [
                'postName' => 'require',
            ], [
                'postName.require' => '名称必须',
            ]);
        } catch (ValidateException $e) {
            return $this->sendError($e->getError());
        }

        if ($this->service->renew($id, $this->request->param()) === false) {
            return $this->sendError();
        }

        return $this->sendSuccess();
    }

    /**
     * 删除岗位.
     *
     * @param [type] $id
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
