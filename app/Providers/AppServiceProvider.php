<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        $this->publishes([
            base_path('vendor/components/jquery')       => public_path('plugins/jquery'),
            base_path('vendor/components/font-awesome') => public_path('plugins/font-awesome'),
            base_path('vendor/twbs/bootstrap/dist')     => public_path('plugins/bootstrap'),
            base_path('vendor/drmonty/chosen')          => public_path('plugins/chosen')
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
