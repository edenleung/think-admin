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

namespace TAnt\Middleware\Log;

class Request
{
    public function handle($request, \Closure $next)
    {
        \think\facade\Log::record($request->url() . '接口请求:' . $request->method(), 'info');
        \think\facade\Log::record($request->param(), 'info');

        return $next($request);
    }
}
