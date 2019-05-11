<?php
namespace app\service\models;

use xiaodi\Permission\Models\Permission as Model;

/**
 * 权限模型
 * 
 */
class Permission extends Model
{
    /**
     * 获取树形结构
     *
     */
    public function getTree()
    {
        $data = $this->order('pid asc')->select();
        $category = new \lib\Category(array('id','pid','title','cname'));
        $res = $category->getTree($data); //获取分类数据树结构
        return $res;
    }

    /**
     * 获取规则详情
     * @param int|string $id
     *
     */
    public function getInfo($id)
    {
        $res = $this->getOrFail($id);

        return $res;
    }

    /**
     * 获取子规则
     * @param string|int $pid
     * @return array
     */
    protected function getChild($pid)
    {
        $data = $this->order('pid asc')->select();
        $category = new \lib\Category(array('id','pid','title','cname'));
        $data = $category->getChild($pid, $data);

        return $data;
    }

    public function getList($page, $pageSize)
    {
        $total = $this->where('pid', 0)->count();
        $top = $this->where('pid', 0)->limit($pageSize)->page($page)->select();
        $data = $this->where('pid', '<>', 0)->select();

        foreach($top as $key=>$v) {
            $actions = $this->getActions($data, $v['id']);
            $top[$key]['actions'] = [];
            $top[$key]['permissionId'] = $v['action'];
            if (!empty($actions)) {
                $top[$key]['action'] = $actions;
            }
        }

        return ['data' => $top, 'pagination' => ['total' => $total, 'current' => intval($page), 'pageSize' => intval($pageSize)]];
    }

    protected function getActions($data, $pid, &$temp = [])
    {
        foreach($data as $v) {
            if ($v['pid'] == $pid) {
                $temp[] = [
                    'role' => $v['action'],
                    'title' => $v['title'],
                    'name' => $v['name'],
                    'pid' => $v['pid'],
                    'id' => $v['id'],
                    'value' => $v['id'],
                    'label' => $v['title'],
                    'status' => $v['status']
                ];
                $temp = array_merge($temp, $this->getActions($data, $v['id']));
            }
        }

        return $temp;
    }
}
