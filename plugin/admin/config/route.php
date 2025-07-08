<?php

use Webman\Route;
use plugin\admin\app\controller\AuthController;
use plugin\admin\app\controller\MenuController;

Route::disableDefaultRoute('admin');
//跨域检测

Route::group('/admin', function () {
    Route::post('/login', [AuthController::class, 'login']);
    Route::get('/login', [AuthController::class, 'login']);
    Route::post('/logout', [AuthController::class, 'logout']);
    Route::get('/user', [AuthController::class, 'user']);

    Route::group('/system', function () {
        Route::group('/menu', function () {
            Route::get('', [MenuController::class, 'index']);
            Route::post('/create', [MenuController::class, 'create']);
            Route::post('/update', [MenuController::class, 'update']);
        });
    });
});
