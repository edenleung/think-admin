<?php
namespace app\service\model\rbac;

use app\service\validate\rbac\GroupValidate;
use think\Model;

/**
 * 角色
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
     * @param array $data
     */
    public function add(array $data)
    {
        try {
            self::validate($data, 'create');
            $this->save($data);
        } catch (\Exception $e) {
            exception($e->getMessage());
        }
    }

    /**
     * 修改规则
     * @param array $data
     */
    public function edit($id, array $data)
    {
        try {
            $info = $this->getInfo($id);
            self::validate($data, 'update');
            $info->save($data);
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
