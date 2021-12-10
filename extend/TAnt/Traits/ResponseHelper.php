<?php

/*
 * This file is part of TAnt.
 * @link     https://github.com/edenleung/think-admin
 * @document https://www.kancloud.cn/manual/thinkphp6_0
 * @contact  QQ Group 996887666
 * @author   Eden Leung 758861884@qq.com
 * @copyright 2019 Eden Leung
 * @license  https://github.com/edenleung/think-admin/blob/6.0/LICENSE.txt
 */

namespace TAnt\Traits;

use think\Response;

trait ResponseHelper
{
    /**
     * sendSuccess.
     *
     * @param array $data
     * @param [type] $msg
     * @param int   $code
     * @param array $header
     */
    protected function sendSuccess($data = [], $msg = null, $code = 20000, $header = []): Response
    {
        $res = [];
        $res['message'] = $msg ?? '操作成功';
        $res['result'] = $data;
        $res['code'] = $code;

        return Response::create($res, 'json', 200)->header($header);
    }

    /**
     * sendError.
     *
     * @param [type] $msg
     * @param int   $code
     * @param array $header
     */
    protected function sendError($msg = null, $code = 50015, $header = []): Response
    {
        $res = [];
        $res['message'] = $msg ?? '操作失败';
        $res['code'] = $code;

        return Response::create($res, 'json', 200)->header($header);
    }
}
