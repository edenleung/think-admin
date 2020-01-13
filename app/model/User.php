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

namespace app\model;

use app\model\validate\UserValidate;
use think\exception\ValidateException;
use xiaodi\Permission\Contract\UserContract;

class User extends \think\Model implements UserContract
{
    use \app\traits\CurdEvent;

    use \xiaodi\Permission\Traits\User;
    use \app\traits\ValidateError;

    /**
     * 创建用户.
     */
    public function addUser(array $data)
    {
        if ($this->validate('create', $data) === false) {
            return false;
        }

        $hash = randomKey();
        $user = User::create([
            'name' => $data['name'],
            'nickname' => $data['nickname'],
            'status' => $data['status'],
            'dept_id' => $data['dept_id'],
            'hash' => $hash,
            'password' => $this->makePassword($data['password'], $hash),
        ]);

        //绑定角色
        $user->bindRole($data['roles']);
    }

    /**
     * 更新角色
     *
     * @param integer $id
     * @param array $data
     * @return void
     */
    public function updateUser(int $id, array $data)
    {
        if ($this->validate('update', $data) === false) {
            return false;
        }

        $user = $this->find($id);

        // 重置密码
        if (isset($data['password'])) {
            $hash = randomKey();
            $user->hash = $hash;
            $user->password = $this->makePassword($data['password'], $hash);
        }

        $user->save([
            'name' => $data['name'],
            'nickname' => $data['nickname'],
            'dept_id' => $data['dept_id'],
            'status' => $data['status'],
        ]);

        // 解除所有已绑定角色
        $user->removeAllRole();

        // 重新绑定角色
        if (! empty($data['roles'])) {
            $user->bindRole($data['roles']);
        }
    }

    /**
     * 删除用户.
     */
    public function deleteUser(int $id)
    {
        $user = $this->find($id);
        if (empty($user)) {
            return false;
        }

        // 解除所有已绑定角色
        $user->removeAllRole();
        return $user->delete();
    }

    /**
     * 获取用户列表.
     */
    public function getList(int $pageNo, int $pageSize, int $deptId = 0)
    {
        $map = [];
        $query = new User;

        // 当前用户所有角色下的数据权限
        $deptIds = $this->getDataAccess();


        $mapDeptIds = [];
        // 指定部门
        if ($deptId) {
            $dept = new Dept;
            $childrenDeptIds = $dept->getChildrenDepts($deptId);

            if (empty($childrenDeptIds)) {
                $childrenDeptIds= [$deptId];
            } else {
                $childrenDeptIds= array_column($childrenDeptIds, 'dept_id');
            }

            foreach($childrenDeptIds as $deptId) {
                if (in_array($deptId, $deptIds)) {
                    $mapDeptIds[] = $deptId;
                }
            }
        } else {
            $mapDeptIds = $deptIds;
        }

        $map[] = ['dept_id', 'in', $mapDeptIds];
        $map[] = ['id', '<>', config('permission.super_id')];
        $map[] = ['id', '<>', $this->id];

        $total = $query->where($map)->count();
        $users = $query->where($map)->limit($pageSize)->page($pageNo)->select();
        foreach ($users as $user) {
            $dept = Dept::find($user->dept_id);
            $user->dept_name = $dept->dept_name;
            $user->rules = $user->getAllPermissions()->column('id');
        }

        return [
            'data' => $users,
            'pageSize' => $pageSize,
            'pageNo' => $pageNo,
            'totalPage' => count($users),
            'totalCount' => $total
        ];
    }

    /**
     * 更新头像.
     */
    public function updateAvatar(string $path)
    {
        $this->avatar = 'storage' . \DIRECTORY_SEPARATOR . $path;
        return $this->save();
    }


    /**
     * 更新个人信息.
     */
    public function updateCurrent(array $data)
    {
        return $this->save($data);
    }

    /**
     * 验证用户密码
     */
    public function verifyPassword(string $password)
    {
        $pwd_peppered = hash_hmac('sha256', $password, $this->hash);

        return \password_verify($pwd_peppered, $this->password);
    }

    /**
     * 修改密码
     */
    public function resetPassword(string $oldPassword, string $newPassword)
    {
        if (! $this->verifyPassword($oldPassword)) {
            $this->error = '原密码不正确';
            return false;
        }

        $this->hash = randomKey();
        $this->password = $this->makePassword($newPassword, $this->hash);

        return  $this->save();
    }

    /**
     * 生成密码.
     */
    protected function makePassword(string $password, string $hash)
    {
        $pwd_peppered = hash_hmac('sha256', $password, $hash);
        return password_hash($pwd_peppered, PASSWORD_DEFAULT);
    }

    /**
     * 验证数据.
     *
     * @param string $scene 验证场景
     * @param array $data 验证数据
     */
    protected function validate(string $scene, array $data)
    {
        try {
            validate(UserValidate::class)
                ->scene($scene)
                ->check($data);
        } catch (ValidateException $e) {
            $this->error = $e->getError();
            return false;
        }

        return true;
    }

    /**
     * 绑定角色.
     */
    protected function bindRole(array $roles)
    {
        $roles = implode(',', $roles);

        //绑定角色
        $roles = Role::whereIn('id', $roles)->select();

        foreach ($roles as $role) {
            $this->assignRole($role);
        }
    }

    /**
     * 获取当前用户数据权限
     *
     * @return array
     */
    public function getDataAccess()
    {
        $deptsIds = [];

        if ($this->isSuper()) {
            return $depts = Dept::select()->column('dept_id');
        }

        foreach($this->roles as $role) {
            $depts = [];
            switch($role->mode) {
                // 全部数据权限
                case 1:
                    $depts = Dept::select()->column('dept_id');
                break;
                // 自定义数据权限
                case 2:
                    $depts = $role->depts->column('dept_id');
                break;
                // 本部门数据权限
                case 3:
                    $depts[] = $this->dept_id;
                break;
                // 本部门及以下数据权限
                case 4:
                    $depts[] = $this->dept_id;
                    $data = Dept::select()->toArray();
                    $category = new \extend\Category(['dept_id', 'dept_pid', 'dept_name', 'cname']);
                    $children = array_column($category->getTree($data, $this->dept_id), 'dept_id');
                    if (!empty($children)) {
                        $depts = array_merge($depts, $children);
                    }
                break;
                // 仅本人数据权限
                case 5:
                    // TODO
                break;
            }
            // 全部数据

            if (!empty($depts)) {
                $deptsIds = array_merge($deptsIds, $depts);
            }
        }

        return $deptsIds;
    }
}
