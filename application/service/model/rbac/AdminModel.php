<?php
namespace app\service\model\rbac;

use think\Model;
use app\service\validate\rbac\AdminValidate;
use app\service\model\rbac\GroupAccessModel;
use think\Db;

/**
 * 后台用户
 */
class AdminModel extends Model
{
    protected $table = 'pg_admin';

    protected $pk = 'admin_id';

    protected $autoWriteTimestamp = true;

    public function setAdminPasswordAttr($value)
    {
        return password_hash($value, PASSWORD_DEFAULT);
    }

    /**
     * 数据验证
     * @param array $data
     * @param string $scene
     */
    public static function validate($data, $scene)
    {
        $validate = new AdminValidate;

        if (!$validate->scene($scene)->check($data)) {
            exception($validate->getError());
        }
    }

    /**
     * 注册用户
     * @param array $params
     */
    public function addUser(array $params)
    {

        Db::startTrans();
        try {
            $groups = $params['groups'];
            self::validate($params, 'create');
            $this->save($params);

            $access = new GroupAccessModel;
            $temp = [];
            foreach ($groups as $v) {
                $temp[] = ['uid' => $this->admin_id, 'group_id' => $v];
            }

            $access->saveAll($temp);
            Db::commit();
        } catch (\Exception $e) {
            Db::rollback();
            exception($e->getMessage());
        }
    }

    /**
     * 修改用户
     * @param array $params
     */
    public function updateUser(int $id, array $params)
    {
        Db::startTrans();
        try {
            $info = $this->getInfo($id);

            self::validate($params, 'edit');

            // 重置密码
            if (isset($params['admin_password'])) {
                $info->admin_password = password_hash($params['admin_password'], PASSWORD_DEFAULT);
            }

            $info->save($params);

            $groups = $params['groups'];
            $this->deleteUserGroup($info->admin_id);

            $access = new GroupAccessModel;
            $temp = [];
            foreach ($groups as $v) {
                $temp[] = ['uid' => $info->admin_id, 'group_id' => $v];
            }

            $access->saveAll($temp);
            Db::commit();
        } catch (\Exception $e) {
            Db::rollback();
            exception($e->getMessage());
        }
    }

    /**
     * 删除用户
     * @param array $params
     */
    public function deleteUser($id)
    {
        Db::startTrans();
        try {

            if ($id == config('auth.auth_super_id')) {
                exception('操作出错');
            }

            $info = $this->getInfo($id);

            $access = new GroupAccessModel;
        
            $map = ['uid' => $info->admin_id];
            $access->where($map)->delete();

            $info->delete();
            Db::commit();
        } catch (\Exception $e) {
            Db::rollback();
            throw $e->getMessage();
        }
    }

    /**
     * 获取用户信息
     * @param string|array $id
     */
    public function getInfo($map)
    {
        $res = $this->getOrFail($map);
        return $res;
    }

    /**
     * 获取用户信息
     * @param string $userName
     */
    public function getUserInfo($userName)
    {
        $res = $this->where([
            'admin_user' => $userName
        ])->find();

        if (empty($res)) {
            exception('没有此用户！');
        }

        return $res;
    }

    /**
     * 获取用户分组ids
     * @param string $uid
     */
    public function getUserGroupIds($uid)
    {
        $access = new GroupAccessModel;
        
        $ids = $access->where(['uid' => $uid])->column('group_id');

        return $ids;
    }

    /**
     * 删除用户分组关联
     * @param string $uid
     */
    public function deleteUserGroup($uid)
    {
        $access = new GroupAccessModel;
        
        $access->where(['uid' => $uid])->delete();
    }

    /**
     * 获取用户权限
     *
     * @return void
     */
    public function getAuthList()
    {
        $accessModel = new GroupAccessModel;
        $groupModel = new GroupModel;
        $ruleModel = new RuleModel;

        if ($this->admin_id === config('auth.auth_super_id')) {
            $rules = $ruleModel->column('id');
        } else {
            $gids = $accessModel->where('uid', $this->admin_id)->column('group_id');
            $groups = $groupModel->where('id', 'in', $gids)->select()->toArray();

            $data = array_column($groups, 'rules');
            $titles = array_column($groups, 'title');
            
            $temp = [];

            foreach($data as $rules) {
                $temp = array_merge($temp, explode(',', $rules));
            }

            $rules = array_unique($temp);
        }

        return $rules;
    }
}
