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
use app\admin\middleware\Permission;

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
Route::group('/permission', function () {
    Route::rule('/', 'system.permission/list', 'GET')->middleware(Permission::class, 'permission-view');
    Route::rule('/', 'system.permission/add', 'POST')->middleware(Permission::class, 'permission-add');
    Route::rule('/:id', 'system.permission/update', 'PUT')->middleware(Permission::class, 'permission-update');
    Route::rule('/:id', 'system.permission/delete', 'DELETE')->middleware(Permission::class, 'permission-delete');
})->allowCrossDomain()->middleware(Jwt::class);

// 角色
Route::group('/role', function () {
    Route::rule('/', 'system.role/list', 'GET')->middleware(Permission::class, 'role-view');
    Route::rule('/', 'system.role/add', 'POST')->middleware(Permission::class, 'role-add');
    Route::rule('/:id$', 'system.role/update', 'PUT')->middleware(Permission::class, 'role-update');
    Route::rule('/:id$', 'system.role/delete', 'DELETE')->middleware(Permission::class, 'role-delete');
    Route::rule('/:id/mode', 'system.role/mode', 'PUT');
})->allowCrossDomain()->middleware(Jwt::class);

// 用户
Route::group('/user', function () {
    //获取 个人信息
    Route::rule('/current$', 'system.user/current', 'GET');
    //更新 个人信息
    Route::rule('/current$', 'system.user/updateCurrent', 'PUT');
    //更新 头像
    Route::rule('/avatar$', 'system.user/avatar', 'POST');
    //更新 密码
    Route::rule('/reset-password$', 'system.user/resetPassword', 'PUT');
    Route::rule('/', 'system.user/list', 'GET')->middleware(Permission::class, 'account-view');
    Route::rule('/', 'system.user/add', 'POST')->middleware(Permission::class, 'account-add');
    Route::rule('/info$', 'system.user/info', 'GET');
    Route::rule('/:id', 'system.user/update', 'PUT')->middleware(Permission::class, 'account-update');
    Route::rule('/:id', 'system.user/delete', 'DELETE')->middleware(Permission::class, 'account-delete');
})->allowCrossDomain()->middleware(Jwt::class);

// 日志
Route::group('/log', function () {
    Route::rule('/acount', 'log/account_list', 'GET')->middleware(Permission::class, 'log-account-view');
    Route::rule('/acount', 'log/account_delete', 'DELETE')->middleware(Permission::class, 'log-account-delete');
    Route::rule('/db', 'log/db_list', 'GET')->middleware(Permission::class, 'log-db-view');
    Route::rule('/db', 'log/db_delete', 'DELETE')->middleware(Permission::class, 'log-db-delete');
})->allowCrossDomain()->middleware(Jwt::class);

Route::group('/system', function () {
    Route::rule('/dept', 'system.dept/list', 'GET')->middleware(Permission::class, 'dept-view');
    Route::rule('/dept', 'system.dept/add', 'POST')->middleware(Permission::class, 'dept-add');
    Route::rule('/dept/:id', 'system.dept/update', 'PUT')->middleware(Permission::class, 'dept-update');
    Route::rule('/dept/:id', 'system.dept/delete', 'DELETE')->middleware(Permission::class, 'dept-delete');
})->allowCrossDomain()->middleware(Jwt::class);

// 模拟数据（可删除）
Route::group('/mock', function () {
    Route::rule('/list/search/projects', 'mock/projects', 'GET');
    Route::rule('/workplace/activity', 'mock/activity', 'GET');
    Route::rule('/workplace/radar', 'mock/radar', 'GET');
    Route::rule('/workplace/teams', 'mock/teams', 'GET');
})->allowCrossDomain();
