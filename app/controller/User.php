<?php

declare(strict_types=1);
/**
 * This file is part of ThinkPHP.
 * @link     https://github.com/xiaodit/think-admin
 * @document https://www.kancloud.cn/manual/thinkphp6_0
 * @contact  group@thinkphp.cn
 * @author   XiaoDi 758861884@qq.com
 * @copyright 2019 Xiaodi
 * @license  https://github.com/xiaodit/think-admin/blob/6.0/LICENSE.txt
 */

namespace app\controller;

use app\model\Permission;
use app\model\Role;
use app\model\User as Model;
use think\Request;

class User extends AbstractController
{
    protected $model;

    public function __construct(Model $model)
    {
        $this->model = $model;
    }

    /**
     * 用户列表.
     *
     * @param mixed $page
     * @param mixed $pageSize
     */
    public function list($page = 1, $pageSize = 1, Permission $permission, Role $role)
    {
        $res['users'] = $this->model->getList($page, $pageSize);

        $res['rules'] = $permission->getList(1, 1000);
        $res['roles'] = $role->getList(1, 1000);
        return $this->sendSuccess($res);
    }

    /**
     * 添加用户.
     */
    public function add()
    {
        if ($this->model->addUser($this->request->param()) === false) {
            return $this->sendError($this->model->getError());
        }

        return $this->sendSuccess();
    }

    /**
     * 更新用户.
     *
     * @param int $id 标识
     */
    public function update(int $id)
    {
        if ($this->model->updateUser($id, $this->request->param()) === false) {
            return $this->sendError($this->model->getError());
        }

        return $this->sendSuccess();
    }

    /**
     * 删除用户.
     *
     * @param int $id 标识
     */
    public function delete(int $id)
    {
        if ($this->model->deleteUser($id) === false) {
            return $this->sendError($this->model->getError());
        }

        return $this->sendSuccess();
    }

    public function info(Request $request)
    {
        $user = $request->user;

        $permission = new Permission();
        // 获取菜单
        $menus = $permission->getMenu();

        // 过滤当前用户能操作权限
        $permissions = [];
        foreach ($menus as $menu) {
            $permission = [];
            if (! empty($menu['child'])) {
                $actionEntity = [];
                foreach ($menu['child'] as $action) {
                    if ($user->can($action['name'])) {
                        $permission['actions'][] = ['action' => $action['name'], 'describe' => $action['title']];
                        $actionEntity[] = ['action' => $action['name'], 'describe' => $action['title'], 'defaultCheck' => false];
                    }
                }

                $permission['permissionId'] = $menu['name'];
                $permission['actionEntitySet'] = $actionEntity;
                $permission['actionList'] = null;
                $permission['dataAccess'] = null;
                $permissions[] = $permission;
            }
        }

        unset($user->password);
        $user->role = ['permissions' => $permissions];

        return $this->sendSuccess($user);
    }

    /**
     * 获取个人信息.
     */
    public function current()
    {
        return $this->sendSuccess($this->model);
    }

    /**
     * 更新个人信息.
     */
    public function updateCurrent()
    {
        $data = $this->request->param();
        if (empty($data)) {
            return $this->sendError('数据出错');
        }

        if (! $this->model->updateCurrent($data)) {
            return $this->sendError('更新失败');
        }

        return $this->sendSuccess(null, '已更新个人信息');
    }

    /**
     * 更新头像.
     */
    public function avatar()
    {
        $file = $this->request->file('file');
        $savename = \think\facade\Filesystem::disk('public')->putFile('topic', $file);
        if (! $this->model->updateAvatar($savename)) {
            return $this->sendError('更新失败');
        }

        return $this->sendSuccess($this->model->avatar, '已成功更换头像');
    }

    /**
     * 修改密码
     *
     * @return void
     */
    public function resetPassword()
    {
        $oldPassword = $this->request->param('oldPassword');
        $newPassword = $this->request->param('newPassword');

        if (!$oldPassword || !$newPassword) {
            return $this->sendError('数据出错');
        }

        if (! $this->model->resetPassword($oldPassword, $newPassword)) {
            return $this->sendError($this->model->getError());
        }

        return $this->sendSuccess(null, '修改成功');
    }
}
