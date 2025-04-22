<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use Midtrans\Config;
use Illuminate\Support\Facades\View;
use App\Http\View\Composers\ProductComposer;
use Carbon\Carbon;
use Illuminate\Support\Facades\DB;

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
        $total_sales = DB::table('order_details')->sum('subtotal');
        $today_sales = DB::table('order_details')
            ->whereDate('created_at', Carbon::today())
            ->sum('subtotal');
        $total_customers = DB::table('customers')->count();
        $total_orders = DB::table('orders')->count();

        // View::share akan membuat variabel ini tersedia di semua view
        View::share(compact('total_sales', 'today_sales', 'total_customers', 'total_orders'));
    }
}
