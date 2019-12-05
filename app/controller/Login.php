<?php

declare(strict_types=1);
/**
 * This file is part of ThinkPHP.
 * @link     https://www.thinkphp.cn
 * @document https://www.kancloud.cn/manual/thinkphp6_0
 * @contact  group@thinkphp.cn
 * @license  https://github.com/top-think/think/blob/6.0/LICENSE.txt
 */

namespace app\controller;

use app\service\UserService;

class Login extends AbstractController
{
    protected $userService;

    public function __construct(UserService $userService)
    {
        $this->userService = $userService;
    }

    public function index()
    {
        $username = $this->request->param('username');
        $password = $this->request->param('password');
        if (false === $this->userService->login($username, $password)) {
            return json(['code' => 50015, 'message' => '登录失败']);
        }

        $token = (string)$this->userService->makeToken();

        return json(['code' => 20000, 'message' => '登录成功', 'data' => ['token' => $token]]);
    }

    public function info($token)
    {
        $user = $this->userService->getUserInfoByToken($token);

        // 是否超级管理员
        if ($user->isSuper()) {
        } else {}

        $info = [
            'name' => 'super',
            'avatar' => 'http://b-ssl.duitang.com/uploads/item/201603/20/20160320095826_x8RcV.thumb.700_0.jpeg',
            'status' => 1,
            'role' => [
                'permissions' => []
            ]
        ];

        return json(['code' => 20000, 'message' => '登录成功', 'data' => $info]);
    }

    public function logout()
    {}
}
