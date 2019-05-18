<?php
namespace app\admin\controller;

use app\common\HttpResponse;
use app\service\UserService;

use xiaodi\Permission\Models\Permission;
use xiaodi\Permission\Models\User;

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
            $uid = $this->service->doLogin($this->params);
        } catch (\Exception $e) {
            return $this->sendError($e->getMessage());
        }

        return $this->sendSuccess(['token' => $this->makeSign($uid)]);
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
        $user = (new User)->getById($uid);

        // 获取用户有权限的规则
        if ($user->id === config('permission.auth_super_id')) {
            // 超级管理员
            $permissions = Permission::where('pid', '<>', 0)->select();
        } else {
            $permissions = $user->getAllPermissions()->toArray();
            $permissions = Permission::where('name', 'in', array_column($permissions, 'content'))->select();
        }

        $info = [
            'name' => $user->nickname,
            'avatar' => 'http://b-ssl.duitang.com/uploads/item/201603/20/20160320095826_x8RcV.thumb.700_0.jpeg',
            'status' => $user->status,
            'role' => [
                'permissions' => []
            ]
        ];

        $parent = Permission::where('pid', 0)->field('id,title,action')->select();

        $temp = [];
        foreach($parent as $key=>$v) {
            $actions = $this->getTree($permissions, $v['id']);
            if (!empty($actions)) {
                $v['permissionId'] = $v['action'];
                $v['actions'] = $actions;
                $actionEntity = [];
                foreach($actions as $action) {
                    $actionEntity[] = ['action' => $action['action'], 'describe' => $action['title'], 'defaultCheck' => false];
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
     * @param [type] $permissions 有权限的规则
     * @param array $temp
     * @return void
     */
    protected function getTree($data, $pid, &$temp = [])
    {
        foreach($data as $v) {
            if ($v['pid'] == $pid) {
                $temp[] = [
                    'action' => $v['action'],
                    'title' => $v['title']
                ];
                $temp = array_merge($temp, $this->getTree($data, $v['id']));
            }
        }

        return $temp;
    }
}
