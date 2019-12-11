<?php
namespace app\Permission\Models;

use think\Db;
use xiaodi\Permission\Models\Role;
use xiaodi\Permission\Models\User as Model;

class User
{
    public function addUser(array $data)
    {
        Db::startTrans();
        try {
            $user = Model::create([
                'name' => $data['name'],
                'nickname' => $data['nickname'],
                'status' => $data['status'],
                'password' => \password_hash($data['password'], PASSWORD_DEFAULT)
            ]);

            $roles = Role::where('id', 'in', $data['roles'])->select();
            foreach($roles as $role) {
                $user->assignRole($role->toArray()['name']);
            }

            Db::commit();
        } catch(\Exception $e) {
            Db::rollback();
            \exception($e->getMessage());
        }
        
    }

    public function updateUser(int $id, array $data)
    {
        Db::startTrans();
        try {
            $model = new Model;
            $user = $model->getById($id);

            // 重置密码
            if (isset($data['password'])) {
                $user->password = password_hash($data['password'], PASSWORD_DEFAULT);
            }

            $user->save([
                'name' => $data['name'],
                'nickname' => $data['nickname'],
                'status' => $data['status']
            ]);

            // 清除中间表数据
            $user->roles()->detach(
                $user->roles()->column('role_id')
            );

            // 重新配置
            $roles = Role::where('id', 'in', $data['roles'])->select();
            foreach($roles as $role) {
                $user->assignRole($role->toArray()['name']);
            }

            Db::commit();
        } catch(\Exception $e) {
            Db::rollback();
            \exception($e->getMessage());
        }
    }

    public function deleteUser($id)
    {
        exception('预览版本 不支持删除');
        
        Db::startTrans();
        try {
            $model = new Model;
            $user = $model->getById($id);

            // 清除中间表数据
            $user->roles()->detach(
                $user->roles()->column('role_id')
            );

            $user->delete();
            Db::commit();
        } catch(\Exception $e) {
            Db::rollback();
            \exception($e->getMessage());
        }
    }

    /**
     * 用户列表
     *
     * @param [type] $page
     * @param [type] $pageSize
     * @return void
     */
    public function getList($page, $pageSize)
    {
        $model = new Model;
        $total = $model->where('id', '<>', config('permission.auth_super_id'))->count();
        $users = $model->where('id', '<>', config('permission.auth_super_id'))->limit($pageSize)->page($page)->field('admin_password', true)->select();

        foreach($users as $user) {
            $rules = $user->getAllPermissions()->toArray();
            $contents = array_column($rules, 'content');

            $rules = Permission::where('name', 'in', $contents)->column('id');
            $user->rules = $rules;
        }

        $data = ['data' => $users, 'pagination' => ['total' => $total, 'current' => intval($page), 'pageSize' => intval($pageSize)]];

        return $data;
    }
}