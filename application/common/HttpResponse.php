<?php
namespace app\common;

use think\Response;
use think\Controller;

/**
 * HttpResponse.
 */
class HttpResponse extends Controller
{
    protected $request;

    protected $params;

    public function __construct()
    {
        parent::__construct();
        $this->request = request();
        $this->params = $this->request->param();
    }

    public function sendSuccess($data = [], $msg = '操作成功', $code = 20000, $header =  [])
    {
        $res = [];
        $res['message'] = $msg;
        $res['data'] = $data;
        $res['code'] = $code;
        
        return response($res, 200, $header, 'json');
    }

    public function sendError($msg = '操作失败', $code = 50015, $header =  [])
    {
        $res = [];
        $res['message'] = $msg;
        $res['code'] = $code;
        
        return response($res, 200, $header, 'json');
    }
}
