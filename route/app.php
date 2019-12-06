<?php
// +----------------------------------------------------------------------
// | ThinkPHP [ WE CAN DO IT JUST THINK ]
// +----------------------------------------------------------------------
// | Copyright (c) 2006~2018 http://thinkphp.cn All rights reserved.
// +----------------------------------------------------------------------
// | Licensed ( http://www.apache.org/licenses/LICENSE-2.0 )
// +----------------------------------------------------------------------
// | Author: liu21st <liu21st@gmail.com>
// +----------------------------------------------------------------------
use think\facade\Route;
use xiaodi\Middleware\Jwt;

Route::get('think', function () {
    return 'Hello,ThinkPHP6!';
});

Route::miss(function () {
    return redirect('think');
});

Route::group('/auth', function () {
    Route::post('/login', 'auth/login');
    Route::get('/logout', 'auth/logout');
})->allowCrossDomain();

// 规则
Route::group('/rule', function () {
    Route::rule('/', 'rule/list', 'GET')->middleware('auth', 'rule-view');
    Route::rule('/', 'rule/add', 'POST')->middleware('auth', 'rule-add');
    Route::rule('/:id', 'rule/update', 'PUT')->middleware('auth', 'rule-update');
    Route::rule('/:id', 'rule/delete', 'DELETE')->middleware('auth', 'rule-delete');
})->allowCrossDomain()->middleware(Jwt::class);

// 角色
Route::group('/role', function () {
    Route::rule('/', 'role/list', 'GET')->middleware('auth', 'role-view');
    Route::rule('/', 'role/add', 'POST')->middleware('auth', 'role-add');
    Route::rule('/:id', 'role/update', 'PUT')->middleware('auth', 'role-update');
    Route::rule('/:id', 'role/delete', 'DELETE')->middleware('auth', 'role-delete');
})->allowCrossDomain()->middleware(Jwt::class);

// 用户
Route::group('/user', function () {
    Route::rule('/', 'user/list', 'GET')->middleware('auth', 'account-view');
    Route::rule('/', 'user/add', 'POST')->middleware('auth', 'account-add');
    Route::rule('/info', 'user/info', 'GET');
    Route::rule('/user/:id', 'user/update', 'PUT')->middleware('auth', 'account-update');
    Route::rule('/user/:id', 'user/delete', 'DELETE')->middleware('auth', 'account-delete');
})->allowCrossDomain()->middleware(Jwt::class);
