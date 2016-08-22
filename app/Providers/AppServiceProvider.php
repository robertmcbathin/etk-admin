<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use DB;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        $unanswered_callbacks_count = DB::table('callbacks')
                                        ->where('processing_by', null)
                                        ->count();
        $new_orders_count = DB::table('orders')
                                        ->where('status', 1)
                                        ->count();
        view()->share([
            'unanswered_callbacks_count' => $unanswered_callbacks_count,
            'new_orders_count' => $new_orders_count
            ]);
    }

    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        //
    }
}
