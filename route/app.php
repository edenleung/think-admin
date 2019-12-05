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

Route::get('think', function () {
    return 'hello,ThinkPHP6!';
});

Route::post('/login/login', 'login/index')->allowCrossDomain();
Route::get('/login/info', 'login/info')->allowCrossDomain();

Route::group('/auth', function () {
    Route::rule('/rule', 'rbac/rules', 'GET');
    Route::rule('/rule', 'rbac/addRule', 'POST');
    Route::rule('/rule/:id', 'rbac/updateRule', 'PUT');
    Route::rule('/rule/:id', 'rbac/deleteRule', 'DELETE');
    Route::rule('/role', 'rbac/roles', 'GET');
    Route::rule('/role', 'rbac/addRole', 'POST');
    Route::rule('/role/:id', 'rbac/updateRole', 'PUT');
    Route::rule('/role/:id', 'rbac/deleteRole', 'DELETE');
    Route::rule('/user', 'rbac/users', 'GET');
    Route::rule('/user', 'rbac/addUser', 'POST');
    Route::rule('/user/:id', 'rbac/updateUser', 'PUT');
    Route::rule('/user/:id', 'rbac/deleteUser', 'DELETE');
})->allowCrossDomain();
