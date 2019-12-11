<?php

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
        if (false === $this->model->addUser($this->request->param()))
        {
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
        if (false === $this->model->updateUser($id, $this->request->param()))
        {
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
        if (false === $this->model->deleteUser($id))
        {
            return $this->sendError($this->model->getError());
        }
        
        return $this->sendSuccess();
    }

    public function info(Request $request)
    {
        $user = $request->user;

        $info = [
            'name' => $user->nickname,
            'avatar' => 'http://b-ssl.duitang.com/uploads/item/201603/20/20160320095826_x8RcV.thumb.700_0.jpeg',
            'status' => $user->status,
            'role' => [
                'permissions' => []
            ]
        ];

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
                        $permission['actions'][] = ['action' => $action['name'], 'title' => $action['title']];
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

        $info['role']['permissions'] = $permissions;
        return $this->sendSuccess($info);
    }
}
