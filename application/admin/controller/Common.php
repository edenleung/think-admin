<?php
namespace app\admin\controller;

use think\Controller;
use think\exception\HttpResponseException;

class Common extends Controller{

    public function __construct()
    {
        parent::__construct();
        
        $this->checkAuth();
    }

    protected function checkAuth()
    {
        dump(request()->routeInfo()['route']);
        // $white = ['admin/index/index'];

        // if (!in_array(request()->xxx(), $white)) {
        //     $response = response('没有权限', 403, [], 'json');
        //     throw new HttpResponseException($response);
        // }
        
    }
}
