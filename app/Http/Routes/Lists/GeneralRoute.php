<?php

namespace App\Http\Routes\Lists;

use App\Http\Controllers\HomeController;
use App\Http\Routes\Core\RouteInterface;
use Illuminate\Support\Facades\Route;

class GeneralRoute implements RouteInterface
{
    public static function list()
    {
        Route::get('home', [HomeController::class, 'index']);
    }
}
