<?php

declare(strict_types=1);

namespace app\controller;

use think\Request;
use app\model\Permission;
use app\model\Role;
use app\model\User as Model;

class User extends AbstractController
{
    protected $model;

    public function __construct(Model $model)
    {
        $this->model = $model;
    }

    /**
     * 用户列表
     *
     * @return void
     */
    public function list($page = 1, $pageSize = 1, Permission $permission, Role $role)
    {
        $res['users'] = $this->model->getList($page, $pageSize);

        $res['rules'] = $permission->getList(1, 1000);
        $res['roles'] = $role->getList(1, 1000);
        return $this->sendSuccess($res);
    }

    /**
     * 添加用户
     *
     * @return void
     */
    public function add()
    {
        if (false === $this->model->addUser($this->request->param())) {
            return $this->sendError($this->model->getError());
        }

        return $this->sendSuccess();
    }

    /**
     * 更新用户
     *
     * @param integer $id 标识
     * @return void
     */
    public function update(int $id)
    {
        if (false === $this->model->updateUser($id, $this->request->param())) {
            return $this->sendError($this->model->getError());
        }

        return $this->sendSuccess();
    }

    /**
     * 删除用户
     *
     * @param integer $id 标识
     * @return void
     */
    public function delete(int $id)
    {
        if (false === $this->model->deleteUser($id)) {
            return $this->sendError($this->model->getError());
        }

        return $this->sendSuccess();
    }

    public function info(Request $request)
    {
        $user = $request->user;

        $permission = new Permission;
        // 获取菜单
        $menus = $permission->getMenu();

        // 过滤当前用户能操作权限
        $permissions = [];
        foreach ($menus as $menu) {
            $permission = [];
            if (!empty($menu['child'])) {
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
     * 获取个人信息
     *
     * @param Model $user
     * @return void
     */
    public function current(Model $user)
    {
        return $this->sendSuccess($user);
    }

    /**
     * 更新个人信息
     *
     * @param Model $user
     * @return void
     */
    public function updateCurrent(Model $user)
    {
        $data = $this->request->param();
        if (empty($data))
        {
            return $this->sendError('数据出错');
        }

        if (!$user->updateCurrent($data))
        {
            return $this->sendError('更新失败');
        }


        return $this->sendSuccess(null, '已更新个人信息');
    }

    /**
     * 更新头像
     *
     * @return void
     */
    public function avatar(Model $user)
    {
        $file = $this->request->file('file');
        $savename = \think\facade\Filesystem::disk('public')->putFile('topic', $file);
        if (!$user->updateAvatar($savename))
        {
            return $this->sendError('更新失败');
        }

        return $this->sendSuccess($user->avatar, '已成功更换头像');
    }
}
