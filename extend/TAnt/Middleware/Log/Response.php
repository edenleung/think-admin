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

class Response
{
    public function handle($request, \Closure $next)
    {
        $response = $next($request);

        $method = request()->method();
        $url = request()->url();

        \think\facade\Log::debug([
            'method' => $method,
            'url' => $url,
            'response' => $response->getContent()
        ]);

        return $response;
    }
}
