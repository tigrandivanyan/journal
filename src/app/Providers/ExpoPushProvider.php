<?php

namespace App\Providers;

use ExponentPhpSDK\Expo;
use Illuminate\Support\Facades\Event;
use Illuminate\Support\ServiceProvider;

class ExpoPushProvider extends ServiceProvider
{
    /**
     * Bootstrap the application services.
     *
     * @return void
     */
    public function boot()
    {
        //
    }

    /**
     * Register the application services.
     *
     * @return void
     */
    public function register()
    {
        $this->app->singleton('expo-push', function ($app) {
            $expo = Expo::normalSetup();
            return $expo;
        });
    }
}
