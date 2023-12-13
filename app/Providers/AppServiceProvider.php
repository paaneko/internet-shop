<?php

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
        //
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
        Relation::enforceMorphMap([
            'product' => 'App\Models\Product',
            'category' => 'App\Models\Category',
            'brand' => 'App\Models\Brand',
        ]);
    }
}
