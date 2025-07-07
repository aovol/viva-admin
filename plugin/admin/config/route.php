<?php

use Webman\Route;
use plugin\admin\app\controller\AuthController;

Route::disableDefaultRoute('admin');
//跨域检测

Route::group('/admin', function () {
    Route::post('/login', [AuthController::class, 'login']);
    Route::get('/login', [AuthController::class, 'login']);
    Route::post('/logout', [AuthController::class, 'logout']);
    Route::get('/user', [AuthController::class, 'user']);
});
