<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use Midtrans\Config;
use Illuminate\Support\Facades\View;
use App\Http\View\Composers\ProductComposer;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        //
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
         // Mendaftarkan ProductComposer untuk view profile.sidebar
         View::composer('profile.sidebar', ProductComposer::class);
    }
}
