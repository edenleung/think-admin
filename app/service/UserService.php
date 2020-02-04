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

namespace app\service;

use app\BaseService;
use app\event\UserLogin;
use app\model\Dept;
use app\model\Permission;
use app\model\Role;
use app\model\User;
use think\facade\Db;
use app\service\PermissionService;

class UserService extends BaseService
{
    /**
     * @param User $user
     */
    public $model;

    public function __construct(User $user)
    {
        $this->model = $user;
    }

    /**
     * 用户登录.
     *
     * @return bool|User
     */
    public function login(string $username, string $password)
    {
        $user = $this->model->getByName($username);
        if (empty($user)) {
            return false;
        }

        if (! $this->verifyPassword($user, $password)) {
            return false;
        }

        event('UserLogin', new UserLogin($user));

        return $user;
    }

    /**
     * 验证用户密码
     *
     * @return bool
     */
    public function verifyPassword(User $user, string $password)
    {
        $pwd_peppered = hash_hmac('sha256', $password, $user->hash);

        return \password_verify($pwd_peppered, $user->password);
    }

    /**
     * 生成用户 Token.
     */
    public function makeToken(User $user)
    {
        return app('jwt')->token(['uid' => $user->id]);
    }

     /**
      * 获取用户信息与菜单列表.
      *
      * @param User $user
      * @return User
      */
    public function info(User $user)
    {
        $permission = new PermissionService(new Permission());

        // 获取所有菜单
        $menus = $permission->getMenu();

        // 过滤当前用户有权限的菜单及操作按钮
        $permissions = $this->filterPermissionMenu($menus, $user);

        unset($user->password, $user->hash);

        $user->role = ['permissions' => $permissions];

        $routes = $permission->getTree();
        $user->menus = $this->formatRoute($routes);

        return $user;
    }

    /**
     * 路由列表.
     *
     * @param array $data
     * @return array
     */
    public function formatRoute($data)
    {
        $routes = [];
        foreach ($data as $item) {
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

            if (! empty($item['children'])) {
                $route['children'] = $this->formatRoute($item['children']);
            }
            $routes[] = $route;
        }

        return $routes;
    }

    /**
     * 获取用户列表.
     */
    public function getList(int $pageNo, int $pageSize, int $deptId = 0)
    {
        $map = [];
        $query = new User();
        $user = request()->user;

        // 当前用户所有角色下的数据权限
        $deptIds = [];

        $mapDeptIds = [];
        // 指定部门
        if ($deptId) {
            $dept = new Dept();
            $childrenDeptIds = $dept->getChildrenDepts($deptId);

            if (empty($childrenDeptIds)) {
                $childrenDeptIds = [$deptId];
            } else {
                $childrenDeptIds = array_column($childrenDeptIds, 'dept_id');
            }

            foreach ($childrenDeptIds as $deptId) {
                if (in_array($deptId, $deptIds)) {
                    $mapDeptIds[] = $deptId;
                }
            }
        } else {
            $mapDeptIds = $deptIds;
        }

        $map[] = ['dept_id', 'in', $mapDeptIds];
        $map[] = ['id', '<>', config('permission.super_id')];
        $map[] = ['id', '<>', $user->id];

        $total = $query->where($map)->count();
        $users = $query->where($map)->limit($pageSize)->page($pageNo)->select();
        foreach ($users as $user) {
            $dept = Dept::find($user->dept_id);
            $user->dept_name = $dept->dept_name;
            $user->rules = $user->getAllPermissions()->column('id');
            $user->posts = $user->posts->column('postId');
        }

        return [
            'data' => $users,
            'pageSize' => $pageSize,
            'pageNo' => $pageNo,
            'totalPage' => count($users),
            'totalCount' => $total,
        ];
    }

    /**
     * 创建用户.
     *
     * @return bool
     */
    public function add(array $input)
    {
        $hash = randomKey();
        $user = User::create([
            'name' => $input['name'],
            'nickname' => $input['nickname'],
            'status' => $input['status'],
            'dept_id' => $input['dept_id'],
            'hash' => $hash,
            'password' => $this->makePassword($input['password'], $hash),
        ]);

        //绑定角色
        $this->bindRole($user, $input['roles']);

        if (! empty($input['posts'])) {
            //绑定岗位
            $this->bindPost($user, $input['posts']);
        }

        return true;
    }

    /**
     * 更新角色.
     *
     * @param int $id
     * @param array $data
     */
    public function renew($id, array $input)
    {
        $user = $this->find($id);

        // 重置密码
        if (isset($input['password'])) {
            $hash = randomKey();
            $user->hash = $hash;
            $user->password = $this->makePassword($input['password'], $hash);
        }

        $user->save([
            'name' => $input['name'],
            'nickname' => $input['nickname'],
            'dept_id' => $input['dept_id'],
            'status' => $input['status'],
        ]);

        // 解除所有已绑定角色
        $user->removeAllRole();

        // 重新绑定角色
        if (! empty($input['roles'])) {
            $this->bindRole($user, $input['roles']);
        }

        if (! empty($input['posts'])) {
            $this->removeAllPost($user);
            //绑定岗位
            $this->bindPost($user, $input['posts']);
        }
    }

    /**
     * 删除用户.
     *
     * @param [type] $id
     * @return bool
     */
    public function remove($id)
    {
        $user = $this->find($id);
        if (empty($user)) {
            return false;
        }

        // 解除所有已绑定角色
        $user->removeAllRole();

        // 删除所有已绑定岗位
        $this->removeAllPost($user);

        return $user->delete();
    }

    /**
     * 解除用户岗位绑定.
     */
    public function removeAllPost(User $user)
    {
        $user->posts()->detach($this->posts->column('postId'));
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
     * 更新个人信息.
     *
     * @return bool
     */
    public function updateCurrent(User $user, array $data)
    {
        return $user->save($data);
    }

    /**
     * 修改密码
     *
     * @return bool
     */
    public function resetPassword(User $user, string $oldPassword, string $newPassword)
    {
        if (! $user->verifyPassword($oldPassword)) {
            $this->error = '原密码不正确';
            return false;
        }

        $user->hash = randomKey();
        $user->password = $this->makePassword($newPassword, $user->hash);

        return  $user->save();
    }

    /**
     * 获取当前用户数据权限.
     *
     * @param string $table
     * @param string $column
     */
    public function getDataAccess($table = '', $column = 'user_id')
    {
        $table = Db::table($table);
        $user = request()->user;
        if ($user->isSuper()) {
            $roles = Role::select();
        } else {
            $roles = $user->roles;
        }

        foreach ($roles as $role) {
            $depts = [];
            switch ($role->mode) {
                    // 全部数据权限
                case 1:
                    $depts = Dept::select();
                    break;
                    // 自定义数据权限
                case 2:
                    $depts = $role->depts;
                    break;
                    // 本部门数据权限
                case 3:
                    $depts = Dept::where('dept_id', $this->dept_id)->select();
                    break;
                    // 本部门及以下数据权限
                case 4:
                    break;
                    // 仅本人数据权限
                case 5:
                    // TODO
                    $table = $table->where($column, $this->id);
                    break;
            }
        }

        return $table->buildSql();
    }

    /**
     * 过滤用户可操作按钮跟查看权限.
     *
     * @param array $data
     * @param User $user
     */
    protected function filterPermissionMenu($data, $user)
    {
        $permissions = [];
        foreach ($data as $menu) {
            if ($menu['type'] == 'menu' && $user->can($menu['name'])) {
                $permission = [];
                $permission['permissionId'] = $menu['name'];
                $permission['actionList'] = [];
                $permission['dataAccess'] = null;
                $actionEntity = [];
                if (! empty($menu['children'])) {
                    foreach ($menu['children'] as $action) {
                        if ($user->can($action['name'])) {
                            $permission['actions'][] = ['action' => $action['name'], 'describe' => $action['title']];
                            $actionEntity[] = ['action' => $action['name'], 'describe' => $action['title'], 'defaultCheck' => false];
                            $permission['actionList'][] = $action['name'];
                        }
                    }
                }

                $permission['actionEntitySet'] = $actionEntity;
                $permissions[] = $permission;
            }
            
            if (! empty($menu['children'])) {
                $permissions = array_merge($permissions, $this->filterPermissionMenu($menu['children'], $user));
            }
        }

        return $permissions;
    }

    /**
     * 生成密码
     *
     * @return string
     */
    protected function makePassword(string $password, string $hash)
    {
        $pwd_peppered = hash_hmac('sha256', $password, $hash);

        return password_hash($pwd_peppered, PASSWORD_DEFAULT);
    }

    /**
     * 用户绑定角色.
     */
    protected function bindRole(User $user, array $roles)
    {
        $roles = implode(',', $roles);

        //绑定角色
        $roles = Role::whereIn('id', $roles)->select();

        foreach ($roles as $role) {
            $user->assignRole($role);
        }
    }

    /**
     * 绑定岗位.
     */
    protected function bindPost(User $user, array $postIds)
    {
        $user->posts()->saveAll($postIds);
    }
}
