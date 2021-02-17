<?php

declare(strict_types=1);

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
