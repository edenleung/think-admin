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

use think\Request;
use think\Response;

class Permission extends \xiaodi\Permission\Middleware\Permission
{
    /**
     * 用户未登录.
     *
     * @param Request $request
     *
     * @return void
     */
    public function handleNotLoggedIn(Request $request): Response
    {
        return Response::create(['message' => '用户未登录', 'code' => 50000], 'json', 401);
    }

    /**
     * 没有权限.
     *
     * @param Request $request
     *
     * @return void
     */
    public function handleNoAuthority(Request $request): Response
    {
        return Response::create(['message' => '没有权限', 'code' => 50403], 'json', 401);
    }
}
