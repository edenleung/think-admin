<?php

declare(strict_types=1);

namespace app\wechat\controller;

use app\BaseController;

class Wechat extends BaseController
{
    public function index()
    {
        $response = app('wechat.official_account')->server->serve();

        $response->send();

        exit;
    }
}
