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

use app\common\model\RequestLog;

class Request
{
    public function handle($request, \Closure $next)
    {
        if (env('APP_DEBUG')) {
            \think\facade\Log::debug([
                'type'    => 'request',
                'method'  => $request->method(),
                'url'     => $request->url(),
                'params'  => $request->getInput(),
                'request' => $request->header(),
            ]);

            // 数据库
//             $log = new RequestLog;
//             $log->save([
//                 'type'     => 'request',
//                 'method'   => request()->method(),
//                 'url'      => $url,
//                 'params'  => json_encode(file_get_contents('php://input')),
//                 'request' => $request->header(),
//             ]);
        }

        return $next($request);
    }
}
