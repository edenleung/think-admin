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

use app\AbstractController;
use app\model\Permission;
use app\model\Role;
use app\model\Dept;
use app\model\User as Model;
use think\Request;

class User extends AbstractController
{
    protected $model;

    public function __construct(Model $model)
    {
        parent::__construct();
        $this->model = $model;
    }

    /**
     * 用户列表.
     *
     * @param mixed $pageNo
     * @param mixed $pageSize
     */
    public function list($pageNo = 1, $pageSize = 10, $deptPid = 0)
    {
        $res['users'] = $this->model->getList((int) $pageNo, (int) $pageSize, (int) $deptPid);
        $res['rules'] = (new Permission)->getMenuPermission();
        $res['roles'] = (new Role)->getSelectTree();
        $res['depts'] = (new Dept)->getTree();
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

    protected function filterPermissionMenu($data, $user)
    {
        $permissions = [];
        foreach ($data as $menu) {
            if ($menu['type'] == 'menu') {
                if (!empty($menu['children'])) {
                    $permission = [];
                    $actionEntity = [];
                    foreach ($menu['children'] as $action) {
                        if ($user->can($action['name'])) {
                            $permission['actions'][] = ['action' => $action['name'], 'describe' => $action['title']];
                            $actionEntity[] = ['action' => $action['name'], 'describe' => $action['title'], 'defaultCheck' => false];
                        }
                    }

                    if (!empty($actionEntity)) {
                        $permission['permissionId'] = $menu['name'];
                        $permission['actionEntitySet'] = $actionEntity;
                        $permission['actionList'] = null;
                        $permission['dataAccess'] = null;
                        $permissions[] = $permission;
                    }
                }
            }
            if (!empty($menu['children'])) {
                $permissions = array_merge($permissions, $this->filterPermissionMenu($menu['children'], $user));
            }
        }

        return $permissions;
    }

    public function info(Request $request)
    {
        $user = $request->user;

        $permission = new Permission();
        // 获取菜单
        $menus = $permission->getMenu();

        // 过滤当前用户能操作权限
        $permissions = $this->filterPermissionMenu($menus, $user);
        unset($user->password);
        unset($user->hash);
        $user->role = ['permissions' => $permissions];

        $tree = $permission->getTree();
        $user->menus = $permission->formatRoute($tree);
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

        if (!$this->model->updateCurrent($data)) {
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
        if (!$this->model->updateAvatar($savename)) {
            return $this->sendError('更新失败');
        }

        return $this->sendSuccess($this->model->avatar, '已成功更换头像');
    }

    /**
     * 修改密码
     */
    public function resetPassword()
    {
        $oldPassword = $this->request->param('oldPassword');
        $newPassword = $this->request->param('newPassword');

        if (!$oldPassword || !$newPassword) {
            return $this->sendError('数据出错');
        }

        if (!$this->model->resetPassword($oldPassword, $newPassword)) {
            return $this->sendError($this->model->getError());
        }

        return $this->sendSuccess(null, '修改成功');
    }
}
