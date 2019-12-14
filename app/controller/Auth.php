<?php

declare(strict_types=1);
/**
 * This file is part of ThinkPHP.
 * @link     https://github.com/xiaodit/think-admin
 * @document https://www.kancloud.cn/manual/thinkphp6_0
 * @contact  group@thinkphp.cn
 * @author   XiaoDi 758861884@qq.com
 * @copyright 2019 Xiaodi
 * @license  https://github.com/xiaodit/think-admin/blob/6.0/LICENSE.txt
 */

namespace app\controller;

use app\service\UserService;
use think\Response;
use xiaodi\Facade\Jwt;

class Auth extends AbstractController
{
    protected $userService;

    public function __construct(UserService $userService)
    {
        $this->userService = $userService;
    }

    /**
     * 登录.
     *
     * @return Response
     */
    public function login()
    {
        $username = $this->request->param('username');
        $password = $this->request->param('password');
        if ($this->userService->login($username, $password) === false) {
            return $this->sendError('登录失败');
        }

        $token = (string) $this->userService->makeToken();

        return $this->sendSuccess(['token' => $token, 'token_type' => Jwt::type(), 'expires_in' => Jwt::ttl()]);
    }

    /**
     * 刷新Token.
     *
     * @param string $token
     * @return Response
     */
    public function refreshToken($token)
    {
        $token = Jwt::parse($token);
        return $this->sendSuccess([
            'token' => Jwt::refresh($token),
            'token_type' => Jwt::type(),
            'expires_in' => Jwt::ttl(),
        ]);
    }

    public function logout()
    {
        // TODO
    }
}
