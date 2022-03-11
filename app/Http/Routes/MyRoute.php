<?php

namespace App\Http\Routes;

use App\Http\Routes\Core\RouteInterface;
use App\Http\Routes\Lists\GeneralRoute;
use Illuminate\Support\Facades\Route;

/**
 * Class MyRoute
 * @package App\Http\Routes
 */
class MyRoute implements RouteInterface
{
    public static function route()
    {
        Route::group(['middleware' => 'auth'], function () {
            self::list();
        });
    }

    public static function list()
    {
        GeneralRoute::list();
    }
}