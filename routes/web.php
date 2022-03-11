<?php

use App\Http\Controllers\Account\UserController;
use App\Http\Controllers\TimeController;
use Illuminate\Support\Facades\Route;
use App\Http\Routes\MyRoute;
use Illuminate\Support\Facades\Auth;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', function () {
    return view('welcome');
});


Route::group(['prefix' => 'auth'], function() {
    Route::post('logout', [UserController::class, 'logout'])->name('logout');

    Route::group(['middleware' => 'guest'], function() {
        Route::group(['prefix' => 'login'], function() {
            Route::get('/', [UserController::class, 'loginPage'])->name('login');
            Route::post('/', [UserController::class, 'login']);
        });

        Route::group(['prefix' => 'register'], function() {
            Route::get('/', [UserController::class, 'registerPage']);
            Route::post('/', [UserController::class, 'register'])->name('register');
        });
    });
});

Route::get('time', [TimeController::class, 'time']);

MyRoute::route();
