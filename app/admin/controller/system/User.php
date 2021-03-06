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
use think\annotation\Inject;
use app\common\service\DeptService;
use app\common\service\RoleService;
use app\common\service\UserService;

class User extends BaseController
{
    protected $validates = [
        'create' => [
            'username' => 'require',
            'nickname' => 'require',
            'password' => 'require',
            'roles'    => 'require',
            'dept_id'  => 'require',
        ],
        'update' => [
            'nickname' => 'require',
            'roles'    => 'require',
            'dept_id'  => 'require',
        ],
    ];

    /**
     * @Inject
     *
     * @var UserService
     */
    protected $service;

    /**
     * @Inject
     *
     * @var DeptService
     */
    protected $dept;

    public function index()
    {
        $params = $this->request->get();

        return $this->sendSuccess([
            'data'  => $this->service->list($params),
            'depts' => $this->dept->getTree(),
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
                'depts' => $dept->getTree(),
            ]
        );
    }

    public function current()
    {
        return $this->sendSuccess(request()->user);
    }

    public function updateCurrent()
    {
        $data = $this->request->post();
        if (empty($data)) {
            return $this->sendError('数据出错');
        }

        if (!$this->service->updateCurrent($this->request->user, $data)) {
            return $this->sendError('更新失败');
        }

        return $this->sendSuccess(null, '已更新个人信息');
    }

    /**
     * 更新头像.
     *
     * @return \think\Response
     */
    public function avatar()
    {
        $file = $this->request->file('file');
        $savename = \think\facade\Filesystem::disk('public')->putFile('topic', $file);
        if (!$this->service->updateAvatar($this->request->user, $savename)) {
            return $this->sendError('更新失败');
        }

        return $this->sendSuccess($this->request->user->avatar, '已成功更换头像');
    }

    /**
     * 修改密码
     *
     * @return \think\Response
     */
    public function resetPassword()
    {
        $oldPassword = $this->request->post('oldPassword');
        $newPassword = $this->request->post('newPassword');

        if (!$oldPassword || !$newPassword) {
            return $this->sendError('数据出错');
        }

        if (!$this->service->resetPassword($this->request->user, $oldPassword, $newPassword)) {
            return $this->sendError($this->service->getError());
        }

        return $this->sendSuccess(null, '修改成功');
    }
}
