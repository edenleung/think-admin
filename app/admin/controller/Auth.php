<?php

declare(strict_types=1);

/*
 * This file is part of TAnt.
 * @link     https://github.com/edenleung/think-admin
 * @document https://www.kancloud.cn/manual/thinkphp6_0
 * @contact  QQ Group 996887666
 * @author   Eden Leung 758861884@qq.com
 * @copyright 2019 Eden Leung
 * @license  https://github.com/edenleung/think-admin/blob/6.0/LICENSE.txt
 */

namespace app\admin\controller;

use think\Response;
use app\BaseController;
use xiaodi\JWTAuth\Facade\Jwt;
use app\admin\service\UserService;

class Auth extends BaseController
{
    /**
     * 用户登录.
     *
     * @return Response
     */
    public function login(UserService $service)
    {
        $username = $this->request->param('username');
        $password = $this->request->param('password');

        $user = $service->login($username, $password);
        if ($user === false) {
            return $this->sendError('登录失败');
        }

        $token = (string) $service->makeToken($user);

        return $this->sendSuccess([
            'token'      => $token,
            'token_type' => Jwt::type(),
            'expires_in' => Jwt::ttl(),
            'refresh_in' => Jwt::refreshTTL(),
        ]);
    }

    /**
     * 刷新Token.
     *
     * @return Response
     */
    public function refreshToken()
    {
        return $this->sendSuccess([
            'token'      => (string) Jwt::refresh(),
            'token_type' => Jwt::type(),
            'expires_in' => Jwt::ttl(),
            'refresh_in' => Jwt::refreshTTL(),
        ]);
    }

    /**
     * 退出登录.
     *
     * @return Response
     */
    public function logout()
    {
        Jwt::logout();

        return $this->sendSuccess();
    }
}
