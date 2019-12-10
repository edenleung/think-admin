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
use xiaodi\Facade\Jwt;
use think\Response;

class Auth extends AbstractController
{
    protected $userService;

    public function __construct(UserService $userService)
    {
        $this->userService = $userService;
    }

    /**
     * 登录
     *
     * @return Response
     */
    public function login()
    {
        $username = $this->request->param('username');
        $password = $this->request->param('password');
        if (false === $this->userService->login($username, $password)) {
            return $this->sendError('登录失败');
        }

        $token = (string) $this->userService->makeToken();

        return $this->sendSuccess(['token' => $token, 'token_type' => Jwt::type(), 'expires_in' => Jwt::ttl()]);
    }

    /**
     * 刷新Token
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
            'expires_in' => Jwt::ttl()
        ]);
    }

    public function logout()
    {
        // TODO
    }
}
