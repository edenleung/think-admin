<?php

namespace app\model;

use xiaodi\Permission\Contract\PermissionContract;
use app\model\validate\PermissionValidate;
use think\exception\ValidateException;

class Permission extends \think\Model implements PermissionContract
{
    use \xiaodi\Permission\Traits\Permission, \app\traits\ValidateError;

    /**
     * 验证数据
     *
     * @param string $scene 验证场景
     * @param array $data 验证数据
     * @return void
     */
    protected function validate(string $scene, array $data)
    {
        try {
            validate(PermissionValidate::class)
                ->scene($scene)
                ->check($data);
        } catch (ValidateException $e) {
            $this->error = $e->getError();
            return false;
        }

        return true;
    }

    /**
     * 添加规则
     *
     * @param array $data
     * @return void
     */
    public function addRule(array $data)
    {
        if (false === $this->validate('create', $data)) {
            return false;
        };

        return Permission::create($data);
    }

    /**
     * 更新规则
     *
     * @param integer $id
     * @param array $data
     * @return void
     */
    public function updateRule(int $id, array $data)
    {
        if (false === $this->validate('update', $data)) {
            return false;
        };

        $rule = $this->find($id);
        if (empty($rule)) {
            return false;
        }

        return $this->find($id)->save($data);
    }

    /**
     * 删除规则
     *
     * @param integer $id
     * @return void
     */
    public function deleteRule(int $id)
    {
        $rule = $this->find($id);
        if (empty($rule)) {
            return false;
        }

        return $rule->delete();
    }

    /**
     * 获取规则列表
     *
     * @param [type] $page
     * @param [type] $pageSize
     * @return void
     */
    public function getList($page, $pageSize)
    {
        $total = $this->where('pid', 0)->count();
        $top = $this->where('pid', 0)->limit($pageSize)->page($page)->select();
        foreach ($top as $permission) {
            $permission->permissionId = $permission->action;
            $permission->actions = $permission->getActions();
        }

        return ['data' => $top, 'tree' => $this->getTree(), 'pagination' => ['total' => $total, 'current' => intval($page), 'pageSize' => intval($pageSize)]];
    }

    /**
     * 获取当前权限下级权限
     *
     * @return void
     */
    protected function getActions()
    {
        $data = Permission::where(['pid' => $this->id])->select();

        foreach ($data as $permission) {
            $permission->value = $permission->id;
            $permission->label = $permission->title;
        }

        return $data;
    }

    /**
     * 获取树形结构
     *
     */
    public function getTree()
    {
        $data = $this->where('pid', 0)->select()->toArray();
        return $data;
    }

    /**
     * 获取顶级分类
     *
     * @return void
     */
    public function getMenu()
    {
        $data = $this->order('pid asc')->select()->toArray();
        $category = new \extend\Category(array('id', 'pid', 'title', 'cname'));
        $res = $category->formatTree($data); //获取分类数据树结构
        return $res;
    }
}
