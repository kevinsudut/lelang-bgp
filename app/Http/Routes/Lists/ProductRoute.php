<?php

namespace App\Http\Routes\Lists;

use App\Http\Controllers\Product\ProductBidHistoryController;
use App\Http\Controllers\Product\ProductController;
use App\Http\Routes\Core\RouteInterface;
use Illuminate\Support\Facades\Route;

class ProductRoute implements RouteInterface
{
    public static function list()
    {
        Route::group(['prefix' => 'product'], function() {
            Route::get('my', [ProductController::class, 'myProduct']);
            Route::get('{id}', [ProductController::class, 'productPage']);
            Route::post('store', [ProductController::class, 'store']);
            Route::post('delete', [ProductController::class, 'destroy']);

            Route::group(['prefix' => 'bid'], function() {
                Route::get('my', [ProductBidHistoryController::class, 'index']);
                Route::post('bidding', [ProductBidHistoryController::class, 'bidding']);
                Route::get('leaderboard', [ProductBidHistoryController::class, 'leaderboard']);
            });
        });
    }
}
