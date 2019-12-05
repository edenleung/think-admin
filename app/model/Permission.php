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
    public function add(array $data)
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
    public function edit(int $id, array $data)
    {
        $this->find($id)->save($data);
    }

    /**
     * 删除规则
     *
     * @param integer $id
     * @return void
     */
    public function remove(int $id)
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
        $data = $this->where('pid', '<>', 0)->select();
        foreach ($top as $key => $v) {
            $actions = $this->getActions($data, $v['id']);
            $top[$key]['actions'] = [];
            $top[$key]['permissionId'] = $v['action'];
            if (!empty($actions)) {
                $top[$key]['actions'] = $actions;
            }
        }

        return ['data' => $top, 'tree' => $this->getTree(), 'pagination' => ['total' => $total, 'current' => intval($page), 'pageSize' => intval($pageSize)]];
    }

    /**
     * Undocumented function
     *
     * @param [type] $data
     * @param [type] $pid
     * @param array $temp
     * @return void
     */
    protected function getActions($data, $pid, &$temp = [])
    {
        foreach ($data as $v) {
            if ($v['pid'] == $pid) {
                $v['value'] = $v['id'];
                $v['label'] = $v['title'];
                $temp[] = $v;
                $temp = array_merge($temp, $this->getActions($data, $v['id']));
            }
        }
        return $temp;
    }

    /**
     * 获取树形结构
     *
     */
    public function getTree()
    {
        $data = $this->order('pid asc')->select();
        $category = new \extend\Category(array('id', 'pid', 'title', 'cname'));
        $res = $category->getTree($data); //获取分类数据树结构
        return $res;
    }
}
