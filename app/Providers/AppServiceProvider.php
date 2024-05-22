<?php

declare(strict_types=1);

namespace App\Providers;

use Illuminate\Database\Eloquent\Relations\Relation;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        if ($this->app->environment('local')) {
            $this->app->register(
                \Laravel\Telescope\TelescopeServiceProvider::class
            );
            $this->app->register(TelescopeServiceProvider::class);
        }
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        /*
         * These service in needed for situation when you need to refactor
         * models, but you already have data in database.
         * e.g. change model path
         */
        //        Relation::enforceMorphMap([
        //            'product' => 'App\Models\Product',
        //            'category' => 'App\Models\Category',
        //            'brand' => 'App\Models\Brand',
        //        ]);
    }
}
