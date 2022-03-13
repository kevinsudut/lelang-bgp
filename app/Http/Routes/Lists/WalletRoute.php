<?php

namespace App\Http\Routes\Lists;

use App\Http\Controllers\Wallet\WalletController;
use App\Http\Routes\Core\RouteInterface;
use Illuminate\Support\Facades\Route;

class WalletRoute implements RouteInterface
{
    public static function list()
    {
        Route::group(['prefix' => 'wallet'], function() {
            Route::get('/', [WalletController::class, 'index']);
            Route::post('topup', [WalletController::class, 'topup']);
        });
    }
}
