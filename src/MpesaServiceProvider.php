<?php

namespace Mobidev\Mpesa;

use Illuminate\Support\ServiceProvider;
use Mobidev\Mpesa\Services\OnlineCheckout;

class MpesaServiceProvider extends ServiceProvider
{
    /**
     * Bootstrap the application services.
     *
     * @return void
     */
    public function boot()
    {

        include __DIR__ . '/routes.php';

        // publish migration files
        $this->publishes(
            [
                __DIR__ . '/migrations' => $this->app->databasePath() . '/migrations'
            ], 'migrations');

        // publish views
        $this->publishes([
            __DIR__ . '/views' => base_path('resources/views/mobidev/mpesa'),
        ], 'views');

        // publish config files
        $this->publishes([
            __DIR__ . '/../../config/config.php' => config_path('mpesa.php'),
        ]);

    }

    /**
     * Register the application services.
     *
     * @return void
     */
    public function register()
    {

        $this->registerPackage();

//        $this->registerConfig();
    }

    /**
     * Register package components
     */
    private function registerPackage()
    {
        // C2B Controller
        $this->app->make('Mobidev\Mpesa\controllers\C2BController');

        // Online Checkout Service
        $this->app->singleton('online_checkout', function () {
            return new OnlineCheckout();
        });
    }

//    /**
//     * Merge user custom and mpesa configs
//     */
//    private function registerConfig()
//    {
//        $this->mergeConfigFrom(
//            __DIR__ . '/config/config.php', 'mpesa'
//        );
//    }
}
