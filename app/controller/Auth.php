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
use app\model\Permission;

class Auth extends AbstractController
{
    protected $userService;

    public function __construct(UserService $userService)
    {
        $this->userService = $userService;
    }

    public function login()
    {
        $username = $this->request->param('username');
        $password = $this->request->param('password');
        if (false === $this->userService->login($username, $password)) {
            return json(['code' => 50015, 'message' => '登录失败']);
        }

        $token = (string) $this->userService->makeToken();

        return $this->sendSuccess(['token' => $token]);
    }

    public function logout()
    {
        // TODO
    }
}
