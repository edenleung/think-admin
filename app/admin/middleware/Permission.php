<?php

declare(strict_types=1);
/**
 * This file is part of TAnt.
 * @link     https://github.com/edenleung/think-admin
 * @document https://www.kancloud.cn/manual/thinkphp6_0
 * @contact  QQ Group 996887666
 * @author   Eden Leung 758861884@qq.com
 * @copyright 2019 Eden Leung
 * @license  https://github.com/edenleung/think-admin/blob/6.0/LICENSE.txt
 */

namespace app\admin\middleware;

use app\model\User;
use think\Request;
use think\Response;
use xiaodi\Permission\Middleware\Permission as BasePermission;

class Permission extends BasePermission
{
    /**
     * 重写 handle.
     *
     * @param Request $request
     * @param [type] $permission
     */
    public function handle($request, \Closure $next, $permission)
    {
        if (! $request->user) {
            return $this->handleNotLoggedIn($request);
        }

        if ($this->requestHasPermission($request, $request->user, $permission) === false) {
            return $this->handleNoAuthority($request);
        }

        // 绑定已登录用户的模型类
        app()->bind(User::class, $request->user);

        return $next($request);
    }

    /**
     * 用户未登录.
     */
    public function handleNotLoggedIn(Request $request): Response
    {
        return Response::create(['message' => '用户未登录', 'code' => 50000], 'json', 401);
    }

    /**
     * 没有权限.
     */
    public function handleNoAuthority(Request $request): Response
    {
        return Response::create(['message' => '没有权限', 'code' => 50403], 'json', 401);
    }
}
