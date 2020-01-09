<?php

declare(strict_types=1);
/**
 * This file is part of TAnt.
 * @link     https://github.com/edenleung/think-admin
 * @document https://www.kancloud.cn/manual/thinkphp6_0
 * @contact  QQ Group 996887666
 * @author   Eden Leung 758861884@qq.com
 * @copyright 2019 Eden Leung
 * @license  https://github.com/edenleung/think-admin/blob/6.0/LICENSE.txt
 */

use think\facade\Route;
use xiaodi\Middleware\Jwt;

Route::get('/', function () {
    return 'Hello,ThinkPHP6!';
});

Route::get('/hello', function () {
    return 'Hello,ThinkPHP6!';
});

Route::miss(function () {
    return 'Miss Route!';
});

Route::group('/auth', function () {
    Route::post('/login', 'auth/login');
    Route::post('/logout', 'auth/logout');
    Route::get('/refresh_token', 'auth/refreshToken');
})->allowCrossDomain();

// 规则
Route::group('/rule', function () {
    Route::rule('/', 'auth.rule/list', 'GET')->middleware('auth', 'rule-view');
    Route::rule('/', 'auth.rule/add', 'POST')->middleware('auth', 'rule-add');
    Route::rule('/:id', 'auth.rule/update', 'PUT')->middleware('auth', 'rule-update');
    Route::rule('/:id', 'auth.rule/delete', 'DELETE')->middleware('auth', 'rule-delete');
})->allowCrossDomain()->middleware(Jwt::class);

// 角色
Route::group('/role', function () {
    Route::rule('/', 'auth.role/list', 'GET')->middleware('auth', 'role-view');
    Route::rule('/', 'auth.role/add', 'POST')->middleware('auth', 'role-add');
    Route::rule('/:id$', 'auth.role/update', 'PUT')->middleware('auth', 'role-update');
    Route::rule('/:id$', 'auth.role/delete', 'DELETE')->middleware('auth', 'role-delete');
    Route::rule('/:id/mode', 'auth.role/mode', 'PUT');
})->allowCrossDomain()->middleware(Jwt::class);

// 用户
Route::group('/user', function () {
    //获取 个人信息
    Route::rule('/current$', 'auth.user/current', 'GET');
    //更新 个人信息
    Route::rule('/current$', 'auth.user/updateCurrent', 'PUT');
    //更新 头像
    Route::rule('/avatar$', 'auth.user/avatar', 'POST');
    //更新 密码
    Route::rule('/reset-password$', 'auth.user/resetPassword', 'PUT');
    Route::rule('/', 'auth.user/list', 'GET')->middleware('auth', 'account-view');
    Route::rule('/', 'auth.user/add', 'POST')->middleware('auth', 'account-add');
    Route::rule('/info$', 'auth.user/info', 'GET');
    Route::rule('/:id', 'auth.user/update', 'PUT')->middleware('auth', 'account-update');
    Route::rule('/:id', 'auth.user/delete', 'DELETE')->middleware('auth', 'account-delete');
})->allowCrossDomain()->middleware(Jwt::class);

// 日志
Route::group('/log', function () {
    Route::rule('/acount', 'log/account_list', 'GET')->allowCrossDomain()->middleware(Jwt::class);
    Route::rule('/acount', 'log/account_delete', 'DELETE')->allowCrossDomain()->middleware(Jwt::class);
    Route::rule('/db', 'log/db_list', 'GET')->allowCrossDomain()->middleware(Jwt::class);
    Route::rule('/db', 'log/db_delete', 'DELETE')->allowCrossDomain()->middleware(Jwt::class);
})->allowCrossDomain()->middleware(Jwt::class);

Route::group('/system', function () {
    Route::rule('/dept', 'system.dept/list', 'GET');
    Route::rule('/dept', 'system.dept/add', 'POST');
    Route::rule('/dept/:id', 'system.dept/update', 'PUT');
    Route::rule('/dept/:id', 'system.dept/delete', 'DELETE');
})->allowCrossDomain()->middleware(Jwt::class);

// 模拟数据（可删除）
Route::group('/mock', function () {
    Route::rule('/list/search/projects', 'mock/projects', 'GET');
    Route::rule('/workplace/activity', 'mock/activity', 'GET');
    Route::rule('/workplace/radar', 'mock/radar', 'GET');
    Route::rule('/workplace/teams', 'mock/teams', 'GET');
})->allowCrossDomain();
