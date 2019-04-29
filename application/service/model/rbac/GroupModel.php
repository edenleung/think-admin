<?php
namespace app\service\model\rbac;

use app\service\validate\rbac\GroupValidate;
use think\Model;

/**
 * 用户分组
 */
class GroupModel extends Model
{
    protected $table = 'pg_auth_group';

    protected $pk = 'id';

    public function setRulesAttr($value)
    {
        if (empty($value)) {
            return '';
        }
        return implode(',', $value);
    }

    /**
     * 数据验证
     * @param array $data
     * @param string $scene
     */
    public static function validate($data, $scene)
    {
        $validate = new GroupValidate;

        if (!$validate->scene($scene)->check($data)) {
            exception($validate->getError());
        }
    }

    /**
     * 添加
     * @param array $params
     */
    public function add(array $params)
    {
        try {
            self::validate($params, 'create');
            $this->save($params);
        } catch (\Exception $e) {
            exception($e->getMessage());
        }
    }

    /**
     * 修改规则
     * @param array $params
     */
    public function edit($id, array $params)
    {
        try {
            $info = $this->getInfo($id);
            self::validate($params, 'update');
            $info->save($params);
        } catch (\Exception $e) {
            exception($e->getMessage());
        }
    }

    /**
     * 删除
     * @param string|int $id
     */
    public function deleteGroup($id)
    {
        try {
            $info = $this->getInfo($id);
            $info->delete();
        } catch (\Exception $e) {
            exception($e->getMessage());
        }
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
     * 获取分组详情
     * @param int|string $id
     *
     */
    public function getInfo($id)
    {
        $res = $this->getOrFail($id);

        return $res;
    }
}
