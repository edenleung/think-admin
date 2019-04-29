<?php
namespace app\admin\controller;

use app\common\HttpResponse;
use app\service\AdminUserService;
use app\service\model\rbac\AdminModel;
use Lcobucci\JWT\Builder;
use Lcobucci\JWT\Parser;

use lib\Category;
/**
 *
 */
class Auth extends HttpResponse
{
    protected $service;

    public function __construct()
    {
        parent::__construct();
        $this->service  = new AdminUserService;
    }

    /**
     * 处理登录
     */
    public function doLogin()
    {
        try {
            $admin_id = $this->service->doLogin($this->params);
        } catch (\Exception $e) {
            return $this->sendError($e->getMessage());
        }

        return $this->sendSuccess(['token' => $this->makeSign($admin_id)]);
    }

    /**
     * 生成token
     * @param int $id
     */
    protected function makeSign($uid)
    {
        $token = (new Builder())
            ->setIssuedAt(time())
            ->setExpiration(time() + (86400 * 3))
            ->set('uid', $uid)
            ->getToken();
        $token->getHeaders();
        $token->getClaims();

        return (string) $token;
    }

    public function info($token)
    {
        $parse = (new Parser())->parse($token);
        $uid = $parse->getClaim('uid');

        // 获取用户信息
        $user = new AdminModel;
        $info = $user->getInfo($uid);

        // 获取用户有权限的规则
        $roles = $info->getAuthList();

        $info = ['id' => '4291d7da9005377ec9aec4a71ea837f', 'name' => $info->admin_nickname, 'username' => 'admin', 'password' => '', 'avatar' => '/avatar2.jpg', 'status' => 1, 'telephone' => '', 'lastLoginIp' => '27.154.74.117', 'lastLoginTime' => 1534837621348, 'creatorId' => 'admin', 'createTime' => 1497160610259, 'merchantCode' => 'TLif2btpzg079h15bk', 'deleted' => 0, 'roleId' => 'admin', 'role' => [
            'id' => 'admin', 'name' => '管理员', 'describe' => '拥有所有权限', 'status' => 1, 'creatorId' => 'system', 'createTime' => 1497160610259, 'deleted' => 0, 'permissions' => []
        ]];

        $data = db('auth_rule')->where('pid', '<>', 0)->order('pid asc')->select();
        $parent = db('auth_rule')->where('pid', 0)->field('id,title,role')->select();

        $temp = [];
        foreach($parent as $key=>$v) {
            $actions = $this->getTree($data, $v['id'], $roles);
            if (!empty($actions)) {
                $v['permissionId'] = $v['role'];
                $v['actions'] = $actions;
                $actionEntity = [];
                foreach($actions as $action) {
                    $actionEntity[] = ['action' => $action['role'], 'describe' => $action['title'], 'defaultCheck' => false];
                }
                $v['actionEntitySet'] = $actionEntity;
                $v['actionList'] = null;
                $v['dataAccess'] = null;

                $temp[] = $v;
            }
        }

        $info['role']['permissions'] = $temp;
        return $this->sendSuccess($info);
    }

    public function logout()
    {
        // todo
        return $this->sendSuccess();
    }

    public function miss()
    {
        return $this->sendError('miss route');
    }

    protected function getTree($data, $pid, $roles, &$temp = [])
    {
        foreach($data as $v) {
            if ($v['pid'] == $pid && in_array($v['id'], $roles)) {
                $temp[] = [
                    'role' => $v['role'],
                    'title' => $v['title']
                ];
                $temp = array_merge($temp, $this->getTree($data, $v['id'], $roles));
            }
        }

        return $temp;
    }
}
