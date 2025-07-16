<?php

use Webman\Route;
use plugin\admin\app\controller\AuthController;
use plugin\admin\app\controller\PermissionController;
use plugin\admin\app\controller\RoleController;
use plugin\admin\app\controller\AdminController;
use plugin\admin\app\controller\NodeController;

Route::disableDefaultRoute('admin');
//跨域检测

Route::group('/admin', function () {
    Route::post('/login', [AuthController::class, 'login']);
    Route::get('/login', [AuthController::class, 'login']);
    Route::post('/logout', [AuthController::class, 'logout']);
    Route::get('/user', [AuthController::class, 'user']);

    Route::group('/system', function () {
        Route::group('/admin', function () {
            Route::get('', [AdminController::class, 'index']);
            Route::post('/create', [AdminController::class, 'create']);
            Route::post('/update', [AdminController::class, 'update']);
            Route::post('/delete', [AdminController::class, 'delete']);
        });

        Route::group('/node', function () {
            Route::get('', [NodeController::class, 'index']);
            Route::post('/create', [NodeController::class, 'create']);
            Route::post('/update', [NodeController::class, 'update']);
            Route::post('/delete', [NodeController::class, 'delete']);
        });

        Route::group('/permission', function () {
            Route::get('', [PermissionController::class, 'index']);
            Route::post('/create', [PermissionController::class, 'create']);
            Route::post('/update', [PermissionController::class, 'update']);
            Route::post('/delete', [PermissionController::class, 'delete']);
            Route::get('/controllers', [PermissionController::class, 'controllers']);
            Route::get('/groups', [PermissionController::class, 'groups']);
        });

        Route::group('/role', function () {
            Route::get('', [RoleController::class, 'index']);
            Route::post('/create', [RoleController::class, 'create']);
            Route::post('/update', [RoleController::class, 'update']);
            Route::post('/delete', [RoleController::class, 'delete']);
        });
    });
});
