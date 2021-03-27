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
use app\common\service\UserService;

class Auth extends BaseController
{
    /**
     * 用户登录.
     *
     * @return Response
     */
    public function login(UserService $service)
    {
        $data = $this->request->post();

        $this->validate($data, [
            'username' => 'require',
            'password' => 'require',
        ]);

        $user = $service->login($data['username'], $data['password']);
        $token = $service->makeToken($user);
        $config = app('jwt.token')->getConfig();

        return $this->sendSuccess([
            'token'      => $token->toString(),
            'token_type' => $config->getType(),
            'expires_in' => $config->getExpires(),
            'refresh_in' => $config->getRefreshTTL(),
        ]);
    }

    /**
     * 刷新Token.
     *
     * @return Response
     */
    public function refreshToken()
    {
        $config = app('jwt.token')->getConfig();

        return $this->sendSuccess([
            'token'      => Jwt::refresh()->toString(),
            'token_type' => $config->getType(),
            'expires_in' => $config->getExpires(),
            'refresh_in' => $config->getRefreshTTL(),
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
