<?php
namespace app\admin\controller;

use app\common\HttpResponse;
use app\service\UserService;
use app\service\models\User;

use Lcobucci\JWT\Builder;
use Lcobucci\JWT\Parser;

class Auth extends HttpResponse
{
    protected $service;

    public function __construct()
    {
        parent::__construct();
        $this->service  = new UserService;
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

    public function logout()
    {
        // todo
        return $this->sendSuccess();
    }

    /**
     * 空路由
     *
     * @return void
     */
    public function miss()
    {
        return $this->sendError('miss route');
    }

    /**
     * 获取用户信息与权限
     *
     * @param [type] $token
     * @return void
     */
    public function info($token)
    {
        $parse = (new Parser())->parse($token);
        $uid = $parse->getClaim('uid');

        // 获取用户信息
        $user = (new User)->getInfo($uid);

        // 获取用户有权限的规则
        $roles = $user->getAllPermissions();

        $info = [
            'name' => $user->admin_nickname,
            'avatar' => 'http://b-ssl.duitang.com/uploads/item/201603/20/20160320095826_x8RcV.thumb.700_0.jpeg',
            'status' => $user->admin_status,
            'role' => [
                'permissions' => []
            ]
        ];

        $data = db('auth_rule')->where('pid', '<>', 0)->order('pid asc')->select();
        $parent = db('auth_rule')->where('pid', 0)->field('id,title,action')->select();

        $temp = [];
        foreach($parent as $key=>$v) {
            $actions = $this->getTree($data, $v['id'], $roles);
            if (!empty($actions)) {
                $v['permissionId'] = $v['action'];
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

    /**
     * 获取所有有权限的规则(Action)
     *
     * @param [type] $data 规则数据
     * @param [type] $pid 父级标识
     * @param [type] $roles 有权限的规则
     * @param array $temp
     * @return void
     */
    protected function getTree($data, $pid, $roles, &$temp = [])
    {
        foreach($data as $v) {
            if ($v['pid'] == $pid && in_array($v['id'], $roles)) {
                $temp[] = [
                    'role' => $v['action'],
                    'title' => $v['title']
                ];
                $temp = array_merge($temp, $this->getTree($data, $v['id'], $roles));
            }
        }

        return $temp;
    }
}
