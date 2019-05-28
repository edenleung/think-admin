<?php
namespace app\Permission\Models;

use app\Permission\Validate\Permission as Validate;
use xiaodi\Permission\Models\Permission as Model;

class Permission extends Model
{
    /**
     * 数据验证
     * @param array $data
     * @param string $scene
     */
    public static function validate(array $data, string $scene)
    {
        $validate = new Validate;
        if (!$validate->scene($scene)->check($data)) {
            exception($validate->getError());
        }
    }

    public function add(array $data)
    {
        self::validate($data, 'create');
        Permission::create($data);
    }

    public function edit(int $id, array $data)
    {
        self::validate($data, 'update');
        $info = $this->getById($id);
        $info->save($data);
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
                $top[$key]['actions'] = $actions;
            }
        }
        return ['data' => $top, 'pagination' => ['total' => $total, 'current' => intval($page), 'pageSize' => intval($pageSize)]];
    }

    protected function getActions($data, $pid, &$temp = [])
    {
        foreach($data as $v) {
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
        $category = new \lib\Category(array('id','pid','title','cname'));
        $res = $category->getTree($data);//获取分类数据树结构
        return $res;
    }

    /**
     * 删除规则
     * @param string|int $id
     */
    public function deleteRule($id)
    {
        exception('预览版本 不支持删除');
        try {
            $info = $this->getById($id);

            // 检查是否有子规则
            $res = $this->getChild($info->id);
            
            if (!empty($res)) {
                exception('请删除子规则');
            }
            
            $info->delete();
        } catch (\Exception $e) {
            exception($e->getMessage());
        }
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

}