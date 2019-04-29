<?php
$allow = '*';

$origin = isset($_SERVER['HTTP_ORIGIN']) ? $_SERVER['HTTP_ORIGIN'] : '';  
$allow_origin = array(  
    'https://ant.xiaodim.com',
    'http://localhost:8000'
);  

if(in_array($origin, $allow_origin)){
    $allow = $origin;
}

Route::group('user', function () {
    Route::rule('login', 'admin/auth/doLogin', 'POST');
    Route::rule('info', 'admin/auth/info', 'GET');
    Route::rule('logout', 'admin/auth/logout', 'POST');
})->header('Access-Control-Allow-Origin', $allow)->allowCrossDomain();

Route::group('/auth', function () {
    Route::rule('/rule', 'admin/rbac/rules', 'GET');
    Route::rule('/rule', 'admin/rbac/addRule', 'POST');
    Route::rule('/rule/:id', 'admin/rbac/updateRule', 'PUT');
    Route::rule('/rule/:id', 'admin/rbac/deleteRule', 'DELETE');
    Route::rule('/tree', 'admin/rbac/getTree', 'GET');

    Route::rule('/role', 'admin/rbac/groups', 'GET');
    Route::rule('/ajax_group', 'admin/rbac/_ajaxGroup', 'GET');
    Route::rule('/role', 'admin/rbac/addGroup', 'POST');
    Route::rule('/role/:id', 'admin/rbac/updateGroup', 'PUT');
    Route::rule('/role/:id', 'admin/rbac/deleteGroup', 'DELETE');

    Route::rule('/user', 'admin/rbac/users', 'GET');
    Route::rule('/user', 'admin/rbac/addUser', 'POST');
    Route::rule('/user/:id', 'admin/rbac/updateUser', 'PUT');
    Route::rule('/user/:id', 'admin/rbac/deleteUser', 'DELETE');
})->header('Access-Control-Allow-Origin', $allow)->allowCrossDomain();

Route::miss('auth/miss')->header('Access-Control-Allow-Origin', $allow)->allowCrossDomain();
Route::rule('test', 'admin/index/index', 'get');
