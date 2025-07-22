<?php

use Webman\Route;
use plugin\event\app\controller\EventController;

Route::group('/event', function () {
    Route::get('/', [EventController::class, 'index']);
});
