<?php

namespace App\Providers;

use App;
use Illuminate\Support\ServiceProvider;

class ConfiguraServiceProvider extends ServiceProvider
{
    /**
     * Register services.
     *
     * @return void
     */
    public function register()
    {
     app()->bind('configura', function(){ 
            return new \App\Helpers\Configura;
        });
    }


    /**
     * Bootstrap services.
     *
     * @return void
     */
    public function boot()
    {
        //
    }
}
