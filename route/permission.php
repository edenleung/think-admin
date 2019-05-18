<?php

$allow = 'https://ant.xiaodim.com';

// 允许跨域白名单
$allow_origin = array(  
    'https://ant.xiaodim.com',
    'https://ele.xiaodim.com',
    'http://localhost:8000',
    'http://localhost:8001'
);  

$origin = isset($_SERVER['HTTP_ORIGIN']) ? $_SERVER['HTTP_ORIGIN'] : '';  

if(in_array($origin, $allow_origin)){
    $allow = $origin;
}

Route::group('user', function () {
    Route::rule('login', 'admin/auth/doLogin', 'POST');
    Route::rule('info', 'admin/auth/info', 'GET');
    Route::rule('logout', 'admin/auth/logout', 'POST');
})->header('Access-Control-Allow-Origin', $allow)->allowCrossDomain();

Route::group('/auth', function () {
    Route::rule('/rule', 'admin/rbac/rules', 'GET')->middleware('\xiaodi\Permission\Middlewares\Permission', 'rule-view');
    Route::rule('/rule', 'admin/rbac/addRule', 'POST')->middleware('\xiaodi\Permission\Middlewares\Permission', 'rule-add');
    Route::rule('/rule/:id', 'admin/rbac/updateRule', 'PUT')->middleware('\xiaodi\Permission\Middlewares\Permission', 'rule-updte');
    Route::rule('/rule/:id', 'admin/rbac/deleteRule', 'DELETE')->middleware('\xiaodi\Permission\Middlewares\Permission', 'rule-delete');
    Route::rule('/tree', 'admin/rbac/_ajaxTree', 'GET');

    Route::rule('/role', 'admin/rbac/roles', 'GET')->middleware('\xiaodi\Permission\Middlewares\Permission', 'role-view');
    Route::rule('/ajax_group', 'admin/rbac/_ajaxGroup', 'GET');
    Route::rule('/role', 'admin/rbac/addRole', 'POST')->middleware('\xiaodi\Permission\Middlewares\Permission', 'role-add');
    Route::rule('/role/:id', 'admin/rbac/updateRole', 'PUT')->middleware('\xiaodi\Permission\Middlewares\Permission', 'role-update');
    Route::rule('/role/:id', 'admin/rbac/deleteRole', 'DELETE')->middleware('\xiaodi\Permission\Middlewares\Permission', 'role-delete');

    Route::rule('/user', 'admin/rbac/users', 'GET')->middleware('\xiaodi\Permission\Middlewares\Permission', 'account-view');
    Route::rule('/user', 'admin/rbac/addUser', 'POST')->middleware('\xiaodi\Permission\Middlewares\Permission', 'account-add');
    Route::rule('/user/:id', 'admin/rbac/updateUser', 'PUT')->middleware('\xiaodi\Permission\Middlewares\Permission', 'account-update');
    Route::rule('/user/:id', 'admin/rbac/deleteUser', 'DELETE')->middleware('\xiaodi\Permission\Middlewares\Permission', 'account-delete');
})->header('Access-Control-Allow-Origin', $allow)->allowCrossDomain();

Route::miss('auth/miss')->header('Access-Control-Allow-Origin', $allow)->allowCrossDomain();
