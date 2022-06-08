<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use App\Studio;
use Illuminate\Support\Facades\View;

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
        view()->composer('admin_panel_view.layout.partials.aside', function ($view) {
            $studiosForBackend = Studio::all()->sortBy('order');
            View::share('studiosForBackend', $studiosForBackend);
        });
    }
}
