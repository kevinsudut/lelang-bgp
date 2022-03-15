<?php

namespace App\Providers;

use App\Models\Account\User;
use App\Models\Notification\Notification;
use App\Models\Product\Product;
use Carbon\Carbon;
use Illuminate\Pagination\Paginator;
use Illuminate\Support\Facades\Gate;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        //
    }

    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        Paginator::useBootstrap();

        Gate::define('delete-product', function(User $user, Product $product) {
            return $user->id === $product->user_id && Carbon::parse($product->start_time)->isAfter(Carbon::now());
        });

        Gate::define('read-notification', function(User $user, Notification $notification) {
            return $user->id === $notification->user_id;
        });

        Gate::define('bidding', function(User $user, Product $product) {
            return $user->id !== $product->user_id;
        });
    }
}
