<?php

declare(strict_types=1);

use think\facade\Route;
use xiaodi\JWTAuth\Middleware\Jwt;

Route::group('/', function () {
    Route::group('/upload', function () {
        Route::post('/file', 'upload/file');
    })->middleware(Jwt::class);;
})->allowCrossDomain();
