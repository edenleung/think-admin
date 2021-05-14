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

use think\facade\Route;

Route::get('/', function () {
    dump(app('auth')->isLogin());
    // return app('jwt')->store('api')->token(1, ['test' => time()])->toString();
    // $result = app('jwt')->store('api')->verify('eyJ0eXAiOiJKV1QiLCJhbGciOiJIUzI1NiJ9.eyJhdWQiOiJzZXJ2ZXIudGFudCIsImlzcyI6ImNsaWVudC50YW50IiwianRpIjoiMSIsImlhdCI6IjE2MTkwMTA2NTAuNzAzMjM5IiwibmJmIjoiMTYxOTAxMDY1MC43MDMyMzkiLCJleHAiOiIxNjIxNjAyNjUwLjcwMzIzOSIsInN1YiI6IjEiLCJzdG9yZSI6ImFwaSIsInRlc3QiOjE2MTkwMTA2NTB9.VC-H0Cz7iQf_jJ9d50-ZzH2YOm0-0SVgXA--1XMnBnA');
    // dump($result);
    // dump(app('jwt.token')->getClaim('jti'));

    // echo session('uid', 1);
    // dump(app('auth')->user());
});
