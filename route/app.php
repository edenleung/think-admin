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
    return 'hello,ThinkPHP6!';
});

Route::post('/login/login', 'login/index')->allowCrossDomain();
Route::get('/login/info', 'login/info')->allowCrossDomain();
Route::get('/login/logout', 'login/logout')->allowCrossDomain();

Route::group('/auth', function () {
    // 规则
    Route::rule('/rule', 'rbac/rules', 'GET')->middleware('auth', 'rule-view');
    Route::rule('/rule', 'rbac/addRule', 'POST')->middleware('auth', 'rule-add');
    Route::rule('/rule/:id', 'rbac/updateRule', 'PUT')->middleware('auth', 'rule-update');
    Route::rule('/rule/:id', 'rbac/deleteRule', 'DELETE')->middleware('auth', 'rule-delete');

    // 角色
    Route::rule('/role', 'rbac/roles', 'GET')->middleware('auth', 'role-view');
    Route::rule('/role', 'rbac/addRole', 'POST')->middleware('auth', 'role-add');
    Route::rule('/role/:id', 'rbac/updateRole', 'PUT')->middleware('auth', 'role-update');
    Route::rule('/role/:id', 'rbac/deleteRole', 'DELETE')->middleware('auth', 'role-delete');

    // 用户
    Route::rule('/user', 'rbac/users', 'GET')->middleware('auth', 'account-view');
    Route::rule('/user', 'rbac/addUser', 'POST')->middleware('auth', 'account-add');
    Route::rule('/user/:id', 'rbac/updateUser', 'PUT')->middleware('auth', 'account-update');
    Route::rule('/user/:id', 'rbac/deleteUser', 'DELETE')->middleware('auth', 'account-delete');
})->allowCrossDomain()->middleware(Jwt::class);
