<?php

namespace app\model;

use xiaodi\Permission\Contract\PermissionContract;

class Permission extends \think\Model implements PermissionContract
{
    use \xiaodi\Permission\Traits\Permission;

    /**
     * 添加规则
     *
     * @param array $data
     * @return void
     */
    public function addRule(array $data)
    {
        Permission::create($data);
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
        $this->find($id)->save($data);
    }

    /**
     * 删除规则
     *
     * @param integer $id
     * @return void
     */
    public function deleteRule(int $id)
    {
        $this->find($id)->delete();
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

        foreach($data as $permission) {
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
        $data = $this->order('pid asc')->select()->toArray();
        $category = new \extend\Category(array('id', 'pid', 'title', 'cname'));
        $res = $category->getTree($data); //获取分类数据树结构
        return $res;
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
