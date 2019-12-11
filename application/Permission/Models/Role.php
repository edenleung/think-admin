<?php
namespace app\Permission\Models;

use app\Permission\Validate\Role as Validate;
use xiaodi\Permission\Models\Permission;
use xiaodi\Permission\Models\Role as Model;

class Role
{
    /**
     * 数据验证
     * @param array $data
     * @param string $scene
     */
    public static function validate($data, $scene)
    {
        $validate = new Validate;
        if (!$validate->scene($scene)->check($data)) {
            exception($validate->getError());
        }
    }

    public function add(array $data)
    {
        self::validate($data, 'create');

        $role = Model::create([
            'name'   => $data['name'],
            'title'  => $data['title'],
            'status' => $data['status']
        ]);

        $permissions = Permission::where('id', 'in', $data['rules'])->select();
        foreach($permissions as $permission)
        {
            $permission = $permission->assignRole($role->toArray()['name']);
        }
    }

    public function edit(int $id, array $data)
    {
        self::validate($data, 'update');
        
        $model = new Model;
        $role = $model->getById($id);
        $role->permissions()->where('model_id', $id)->delete();

        $delete = array_diff(array_column($role->access->toArray(), 'id'), $data['rules']);
        if (!empty($delete)) {
            $role->access()->detach($delete);
        }
        
        $permissions = Permission::where('id', 'in', $data['rules'])->select();
        foreach($permissions as $permission)
        {
            $permission = $permission->assignRole($role->toArray()['name']);
        }
    }

    public function deleteRole(int $id)
    {
        exception('预览版本 不支持删除');
        
        $model = new Model;
        $role = $model->getById($id);
        $role->revokeAllPermission();
        $role->delete();
    }

    public function getList($page, $pageSize)
    {
        $total = Model::count();
        $roles = Model::limit($pageSize)->page($page)->select();

        foreach($roles as $role) {
            $role->permissions = $role->access()->column('id');
        }


        return ['data' => $roles, 'pagination' => ['total' => $total, 'current' => intval($page), 'pageSize' => intval($pageSize)]];
    }

}