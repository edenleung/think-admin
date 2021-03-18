<?php

namespace TAnt\Traits;

use think\Response;

trait ResponseHelper
{
    /**
     * sendSuccess.
     *
     * @param array  $data
     * @param [type] $msg
     * @param int    $code
     * @param array  $header
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
     * @param int    $code
     * @param array  $header
     */
    protected function sendError($msg = null, $code = 50015, $header = []): Response
    {
        $res = [];
        $res['message'] = $msg ?? '操作失败';
        $res['code'] = $code;

        return Response::create($res, 'json', 200)->header($header);
    }
}
