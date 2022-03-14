<?php

namespace App\Http\Routes\Lists;

use App\Http\Controllers\Notification\NotificationController;
use App\Http\Routes\Core\RouteInterface;
use Illuminate\Support\Facades\Route;

class NotificationRoute implements RouteInterface
{
    public static function list()
    {
        Route::group(['prefix' => 'notification'], function() {
            Route::get('/', [NotificationController::class, 'index']);
            Route::get('read-all', [NotificationController::class, 'readAll']);
            Route::get('{id}', [NotificationController::class, 'read']);
        });
    }
}
