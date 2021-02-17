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
use app\common\service\UserService;
use app\common\service\DeptService;
use app\common\service\RoleService;
use think\annotation\Inject;

class User extends BaseController
{
    protected $validates = [
        'create' => [
            'username' => 'require',
            'nickname' => 'require',
            'password' => 'require',
            'roles' => 'require',
            'dept_id' => 'require',
        ],
        'update' => [
            'nickname' => 'require',
            'roles' => 'require',
            'dept_id' => 'require',
        ]
    ];

    /**
     *
     * @Inject
     *
     * @var UserService
     */
    protected $service;

    /**
     *
     * @Inject
     *
     * @var DeptService
     */
    protected $dept;

    public function index()
    {
        $params = $this->request->get();

        return $this->sendSuccess([
            'data' => $this->service->list($params),
            'depts' => $this->dept->getTree()
        ]);
    }

    public function create()
    {
        $data = $this->request->post();
        $this->validteData($data, 'create');
        $result = $this->service->create($data);

        if ($result !== false) {
            return $this->sendSuccess();
        }

        return $this->sendError($this->service->getError());
    }

    public function update($id)
    {
        $data = $this->request->put();
        $this->validteData($data, 'update');
        $result = $this->service->update($id, $data);

        if ($result !== false) {
            return $this->sendSuccess();
        }

        return $this->sendError($this->service->getError());
    }

    public function delete($id)
    {
        $result = $this->service->delete($id);
        if ($result !== false) {
            return $this->sendSuccess();
        }

        return $this->sendError($this->service->getError());
    }

    public function info()
    {
        $info = $this->service->info();
        return $this->sendSuccess($info);
    }

    public function view($id)
    {
        $info = $this->service->view($id);
        return $this->sendSuccess($info);
    }

    public function data(RoleService $role, DeptService $dept)
    {
        return $this->sendSuccess(
            [
                'roles' => $role->all(),
                'depts' => $dept->getTree()
            ]
        );
    }
}
