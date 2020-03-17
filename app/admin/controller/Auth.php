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
use xiaodi\Facade\Jwt;
use app\BaseController;
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
            'token' => (string) Jwt::refresh($token),
            'token_type' => Jwt::type(),
            'expires_in' => Jwt::ttl(),
        ]);
    }

    /**
     * 退出登录.
     */
    public function logout()
    {
        // TODO
        return $this->sendSuccess();
    }
}
