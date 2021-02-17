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

namespace app\api\middleware;

use think\App;
use xiaodi\JWTAuth\Exception\JWTException;

class Member
{
    protected $app;

    public function __construct(App $app)
    {
        $this->app = $app;
    }

    public function handle($request, \Closure $next, $store = null)
    {
        if (true === $this->app->get('jwt')->store($store)->verify()) {
            $user = $this->app->get('jwt.user');

            if ($user->getBind()) {
                if ($info = $user->get()) {
                    // 路由注入
                    $request->user = $info;

                    // 绑定当前用户模型
                    $model = $user->getClass();
                    $this->app->bind($model, $info);
                }
            }

            return $next($request);
        }

        throw new JWTException('Token 验证不通过', 401);
    }
}
