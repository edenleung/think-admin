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

namespace app\common\service;

use app\BaseService;
use app\common\model\Menu;
use app\common\model\Role;
use app\common\model\User;
use tauthz\facade\Enforcer;

class UserService extends BaseService
{
    /**
     * @var User
     */
    protected $model;

    protected $pageSize = 10;

    public function __construct(User $model)
    {
        parent::__construct($model);
    }

    public function login(string $username, string $password)
    {
        $user = $this->model->where('username', $username)->find();
        if ($user && $this->verifyPassword($user, $password)) {
            return $user;
        }

        exception('登录失败');
    }

    /**
     * 验证用户密码
     *
     * @return bool
     */
    public function verifyPassword(User $user, string $password)
    {
        return \password_verify($password, $user->password);
    }

    /**
     * 生成用户 Token.
     */
    public function makeToken(User $user)
    {
        return app('jwt')->token($user->id);
    }

    public function info()
    {
        $service = new MenuService(new Menu());
        $menus = $service->getTree();

        // 过滤当前用户有权限的菜单及操作按钮
        $permissions = $this->filterPermissionMenu($menus, $this->model);

        unset($this->model->password);

        $this->model->role = ['permissions' => $permissions];

        $this->model->menus = $this->formatRoute($menus);

        $this->model->is_super = $this->model->super();

        return $this->model;
    }

    /**
     * 路由列表.
     *
     * @param array $menus
     *
     * @return array
     */
    protected function formatRoute($menus)
    {
        $routes = [];
        foreach ($menus as $item) {
            $route = [];
            $route['path'] = $item['path'];
            $route['name'] = $item['name'];
            $route['component'] = $item['component'];
            $route['meta']['title'] = $item['title'];

            $item['keepAlive'] === 1 && $route['meta']['keepAlive'] = true;
            $item['icon'] && $route['meta']['icon'] = $item['icon'];
            $item['permission'] && $route['meta']['permission'] = explode(',', $item['permission']);
            $item['redirect'] && $route['redirect'] = $item['redirect'];
            $item['hideChildrenInMenu'] === 1 && $route['hideChildrenInMenu'] = true;
            $item['hidden'] === 1 && $route['hidden'] = true;
            $item['blank'] === 1 && $route['meta']['target'] = '_blank';

            if (!empty($item['children'])) {
                $route['children'] = $this->formatRoute($item['children']);
            }
            $routes[] = $route;
        }

        return $routes;
    }

    protected function filterPermissionMenu($menus, $user)
    {
        $permissions = [];
        foreach ($menus as $menu) {
            if ($menu['type'] == 'menu') {
                $permission = [];
                $permission['permissionId'] = $menu['name'];
                $permission['actionList'] = [];
                $permission['dataAccess'] = null;
                $actionEntity = [];
                if (!empty($menu['actions'])) {
                    foreach ($menu['actions'] as $action) {
                        if ($user->can($menu['name'], $action['name'])) {
                            $permission['actions'][] = ['action' => $action['name'], 'describe' => $action['title']];
                            $actionEntity[] = [
                                'action'       => $action['name'],
                                'describe'     => $action['title'],
                                'defaultCheck' => false,
                            ];
                            $permission['actionList'][] = $action['name'];
                        }
                    }
                    $permission['actionEntitySet'] = $actionEntity;
                } else {
                    $permission['actionList'][] = $menu['name'];
                    $permission['actions'][] = ['action' => $menu['name'], 'describe' => $menu['title']];
                    $permission['actionEntitySet'][] = [
                        'action'       => $menu['name'],
                        'describe'     => $menu['title'],
                        'defaultCheck' => false,
                    ];
                }

                if (!empty($actionEntity)) {
                    $permissions[] = $permission;
                }
            }

            if (!empty($menu['children'])) {
                $permissions = array_merge($permissions, $this->filterPermissionMenu($menu['children'], $user));
            }
        }

        return $permissions;
    }

    public function list(array $query)
    {
        $pageNo = isset($query['pageNo']) ? $query['pageNo'] : 1;
        $pageSize = isset($query['pageSize']) ? $query['pageSize'] : $this->pageSize;

        $data = $this->model->alias('a')->with(['dept'])->where('a.id', '<>', 1)->where(function ($q) {
        })->paginate([
            'list_rows' => $pageSize,
            'page'      => $pageNo,
        ]);

        return [
            'data'       => $data->items(),
            'pageSize'   => (int) $pageSize,
            'pageNo'     => (int) $pageNo,
            'totalPage'  => count($data->items()),
            'totalCount' => $data->total(),
        ];
    }

    public function create(array $data)
    {
        $this->transaction(function () use ($data) {
            $user = new User();
            $user->save($data);

            $roles = Role::whereIn('id', $data['roles'])->select();
            foreach ($roles as $role) {
                Enforcer::addRoleForUser($user->username, $role->title);
            }
        });
    }

    public function update($id, array $data)
    {
        $this->transaction(function () use ($id, $data) {
            $user = new User();
            $user = $user->find($id);

            Enforcer::deleteRolesForUser($user->username);

            $user->save($data);

            $roles = Role::whereIn('id', $data['roles'])->select();
            foreach ($roles as $role) {
                Enforcer::addRoleForUser($user->username, $role->title);
            }
        });
    }

    public function view($id)
    {
        $user = new User();
        $user = $user->with(['roles'])->find($id);

        return $user;
    }

    /**
     * 更新个人信息.
     *
     * @return bool
     */
    public function updateCurrent(User $user, array $data)
    {
        return $user->save($data);
    }

    /**
     * 更新头像.
     *
     * @return bool
     */
    public function updateAvatar(User $user, string $path)
    {
        $user->avatar = 'storage' . \DIRECTORY_SEPARATOR . $path;

        return $user->save();
    }

    /**
     * 修改密码
     *
     * @return bool
     */
    public function resetPassword(User $user, string $oldPassword, string $newPassword)
    {
        if (!password_verify($oldPassword, $user->password)) {
            exception('原密码不正确');
        }

        $user->password = $newPassword;

        return $user->save();
    }
}
