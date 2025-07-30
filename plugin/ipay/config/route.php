<?php

use Webman\Route;
use plugin\ipay\app\controller\OrderController;
use plugin\ipay\app\controller\ChannelController;
use plugin\ipay\app\controller\ChannelTypeController;
use plugin\ipay\app\controller\SettingController;

Route::disableDefaultRoute('ipay');

Route::group('/admin/ipay', function () {
    Route::get('/order', [OrderController::class, 'index']);
    Route::group('/channel', function () {
        Route::get('', [ChannelController::class, 'index']);
        Route::post('/create', [ChannelController::class, 'create']);
        Route::put('/update', [ChannelController::class, 'update']);
        Route::delete('/delete', [ChannelController::class, 'delete']);
        Route::group('/type', function () {
            Route::get('', [ChannelTypeController::class, 'index']);
            Route::post('/create', [ChannelTypeController::class, 'create']);
            Route::put('/update', [ChannelTypeController::class, 'update']);
            Route::delete('/delete', [ChannelTypeController::class, 'delete']);
        });
    });
    Route::get('/setting', [SettingController::class, 'index']);
});
