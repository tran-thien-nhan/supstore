<?php

namespace App\Providers;

use App\Helpers\CustomCart;
use Illuminate\Support\ServiceProvider;

class CustomShoppingCartProvider extends ServiceProvider
{
    /**
     * Register services.
     */
    public function register()
    {
        // Override the ShoppingCart instance with a custom instance
        $this->app->bind('cart', function ($app) {
            return new CustomCart(
                $app[\Illuminate\Session\SessionManager::class], // Đảm bảo thứ tự đúng đây
                $app[\Illuminate\Contracts\Events\Dispatcher::class] // Đảm bảo thứ tự đúng đây
            );
        });
    }

    /**
     * Bootstrap services.
     */
    public function boot(): void
    {
        //
    }
}
