<?php

namespace Mobidev\Mpesa;

use Illuminate\Support\ServiceProvider;

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
        $this->publishes(
            [
                __DIR__ . '/migrations' => $this->app->databasePath() . '/migrations'
            ], 'migrations');

        $this->publishes([
            __DIR__ . '/views' => base_path('resources/views/mobidev/mpesa'),
        ], 'views');

    }

    /**
     * Register the application services.
     *
     * @return void
     */
    public function register()
    {
        $this->app->make('Mobidev\Mpesa\controllers\C2BController');
    }
}
