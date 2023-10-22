<?php

namespace Src\Provider;

use Illuminate\Support\ServiceProvider;

class DatabseServiceProvider extends ServiceProvider
{
    /**
     * Register services.
     *
     * @return void
     */
    public function register()
    {
        //
    }

    /**
     * Bootstrap services.
     *
     * @return void
     */
    public function boot()
    {
        $this->loadMigrationsFrom(__DIR__.'/database/migrations');

        $this->publishes([
            __DIR__.'/database/migrations' => database_path('migrations'),
        ], 'myan-map-migrations');
    }
}
