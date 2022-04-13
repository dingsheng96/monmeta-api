<?php

namespace App\Providers;

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\ServiceProvider;

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
        Schema::defaultStringLength(255);

        Model::preventLazyLoading();

        foreach (config('facades.accessors') as $facade => $class) {
            $this->app->bind($facade, function () use ($class) {
                return new $class();
            });
        }
    }
}
