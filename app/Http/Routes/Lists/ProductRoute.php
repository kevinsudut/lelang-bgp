<?php

namespace App\Http\Routes\Lists;

use App\Http\Controllers\Product\ProductController;
use App\Http\Routes\Core\RouteInterface;
use Illuminate\Support\Facades\Route;

class ProductRoute implements RouteInterface
{
    public static function list()
    {
        Route::group(['prefix' => 'product'], function() {
            Route::get('my', [ProductController::class, 'myProduct']);
            Route::get('add', [ProductController::class, 'addProduct']);
        });
    }
}
