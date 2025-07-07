<?php

use Webman\Route;
use plugin\admin\app\controller\AuthController;

Route::disableDefaultRoute('admin');
Route::group('/admin', function () {
    Route::post('/login', [AuthController::class, 'login']);
    Route::post('/logout', [AuthController::class, 'logout']);
    Route::get('/user', [AuthController::class, 'user']);
});
