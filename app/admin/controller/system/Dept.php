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
use app\service\DeptService;
use think\exception\ValidateException;

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
    public function add()
    {
        $data = $this->request->param();

        try {
            $this->validate($data, [
                'dept_name' => 'require|unique:dept',
                'dept_pid' => 'require',
            ], [
                'dept_pid.require' => '父级必须',
                'dept_name.require' => '名称必须',
                'dept_name.unique' => '规则重复',
            ]);
        } catch (ValidateException $e) {
            return $this->sendError($e->getError());
        }

        if (! $this->service->add($data)) {
            return $this->sendError($this->model->getError());
        }

        return $this->sendSuccess();
    }

    /**
     * 更新部门.
     *
     * @param [type] $id
     * @return \think\Response
     */
    public function update($id)
    {
        $data = $this->request->param();

        try {
            $this->validate($data, [
                'dept_name' => 'require|unique:dept',
                'dept_pid' => 'require',
            ], [
                'dept_pid.require' => '父级必须',
                'dept_name.require' => '名称必须',
                'dept_name.unique' => '规则重复',
            ]);
        } catch (ValidateException $e) {
            return $this->sendError($e->getError());
        }

        if (! $this->service->renew($id, $data)) {
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
