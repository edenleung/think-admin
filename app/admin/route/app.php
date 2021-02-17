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
use xiaodi\JWTAuth\Middleware\Jwt;
use app\admin\middleware\Permission;

Route::pattern([
    'id'   => '\d+',
]);
Route::get('/', function () {
    return 'Hello,ThinkPHP6!';
});

Route::get('/hello', function () {
    return 'Hello,ThinkPHP6!';
});

Route::group('auth', function () {
    Route::post('/login', 'auth/login');
    Route::post('/logout', 'auth/logout');
    Route::get('/refresh_token', 'auth/refreshToken');
});

Route::group('menu', function () {
    Route::get('/$', 'system.menu/index');
    Route::get('/:id$', 'system.menu/all');
    Route::get('/tree', 'system.menu/tree');
    Route::post('/', 'system.menu/create');
    Route::put('/:id', 'system.menu/update');
    Route::delete('/:id', 'system.menu/delete');
})->middleware(Jwt::class);

Route::group('/action', function () {
    Route::post('/', 'system.action/create');
    Route::put('/:id', 'system.action/update');
    Route::delete('/:id', 'system.action/delete');
})->middleware(Jwt::class);

Route::group('/dept', function () {
    Route::get('/', 'system.dept/tree');
    Route::post('/', 'system.dept/create');
    Route::put('/:id', 'system.dept/update');
    Route::delete('/:id', 'system.dept/delete');
})->middleware(Jwt::class);

Route::group('/role', function () {
    Route::get('/$', 'system.role/index');
    Route::get('/:id$', 'system.role/info');
    Route::post('/', 'system.role/create');
    Route::put('/:id', 'system.role/update');
    Route::delete('/:id', 'system.role/delete');
    Route::get('/config$', 'system.role/config');
})->middleware(Jwt::class);

// 用户
Route::group('/user', function () {
    Route::get('/data', 'system.user/data');
    //获取 个人信息
    Route::get('/current$', 'system.user/current');
    //更新 个人信息
    Route::put('/current$', 'system.user/updateCurrent');
    //更新 头像
    Route::post('/avatar$', 'system.user/avatar');
    //更新 密码
    Route::put('/reset-password$', 'system.user/resetPassword');
    Route::get('/', 'system.user/index');
    Route::post('/', 'system.user/create');
    Route::get('/info$', 'system.user/info');
    Route::put('/:id', 'system.user/update');
    Route::delete('/:id', 'system.user/delete');
    Route::get('/:id', 'system.user/view');
})->middleware(Jwt::class);


// 模拟数据（可删除）
Route::group('/mock', function () {
    Route::rule('/list/search/projects', 'mock/projects', 'GET');
    Route::rule('/workplace/activity', 'mock/activity', 'GET');
    Route::rule('/workplace/radar', 'mock/radar', 'GET');
    Route::rule('/workplace/teams', 'mock/teams', 'GET');
});
