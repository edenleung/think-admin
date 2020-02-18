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

use app\admin\request\UserRequest;
use app\BaseController;
use app\service\DeptService;
use app\service\PermissionService;
use app\service\PostService;
use app\service\RoleService;
use app\service\UserService;
use think\Request;

class User extends BaseController
{
    protected $permission;

    protected $role;

    protected $post;

    protected $dept;

    public function __construct(UserService $service, PermissionService $permission, RoleService $role, PostService $post, DeptService $dept)
    {
        $this->service = $service;
        $this->permission = $permission;
        $this->role = $role;
        $this->post = $post;
        $this->dept = $dept;
    }

    /**
     * 用户列表.
     *
     * @param [type] $pageNo
     * @param [type] $pageSize
     * @param int $deptPid
     * @return \think\Response
     */
    public function list($pageNo, $pageSize, $deptPid = 0)
    {
        $res['users'] = $this->service->getList((int) $pageNo, (int) $pageSize, (int) $deptPid);
        $res['rules'] = $this->permission->getMenuPermission();
        $res['roles'] = $this->role->getSelectTree();
        $res['depts'] = $this->dept->getTree();
        $res['posts'] = $this->post->all();

        return $this->sendSuccess($res);
    }

    /**
     * 添加用户.
     *
     * @return \think\Response
     */
    public function add(UserRequest $request)
    {
        $request->scene('create')->validate();

        if ($this->service->add($request->param()) === false) {
            $error = $this->service->getError();
            return $this->sendError($error);
        }

        return $this->sendSuccess();
    }

    /**
     * 更新用户.
     *
     * @param [type] $id
     * @return \think\Response
     */
    public function update($id, UserRequest $request)
    {
        $request->scene('update')->validate();

        if ($this->service->renew($id, $request->param()) === false) {
            return $this->sendError($this->service->getError());
        }

        return $this->sendSuccess();
    }

    /**
     * 删除用户.
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

    /**
     * 获取用户信息与菜单列表.
     *
     * @return \think\Response
     */
    public function info(Request $request)
    {
        $user = $request->user;
        $result = $this->service->info($user);
        return $this->sendSuccess($result);
    }

    /**
     * 获取个人信息.
     */
    public function current(User $user)
    {
        return $this->sendSuccess($user);
    }

    /**
     * 更新个人信息.
     *
     * @return \think\Response
     */
    public function updateCurrent(Request $request)
    {
        $data = $this->request->param();
        if (empty($data)) {
            return $this->sendError('数据出错');
        }

        if (! $this->service->updateCurrent($request->user, $data)) {
            return $this->sendError('更新失败');
        }

        return $this->sendSuccess(null, '已更新个人信息');
    }

    /**
     * 更新头像.
     *
     * @return \think\Response
     */
    public function avatar(Request $request)
    {
        $file = $this->request->file('file');
        $savename = \think\facade\Filesystem::disk('public')->putFile('topic', $file);
        if (! $this->service->updateAvatar($request->user, $savename)) {
            return $this->sendError('更新失败');
        }

        return $this->sendSuccess($request->user->avatar, '已成功更换头像');
    }

    /**
     * 修改密码
     *
     * @return \think\Response
     */
    public function resetPassword(Request $request)
    {
        $oldPassword = $this->request->param('oldPassword');
        $newPassword = $this->request->param('newPassword');

        if (! $oldPassword || ! $newPassword) {
            return $this->sendError('数据出错');
        }

        if (! $this->service->resetPassword($request->user, $oldPassword, $newPassword)) {
            return $this->sendError($this->service->getError());
        }

        return $this->sendSuccess(null, '修改成功');
    }
}
