<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use App\Repositories\GoodsRepository;
use App\Repositories\RubricRepository;
use App\Models\Goods;
use App\Models\Rubric;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        $this->app->bind(GoodsRepository::class, function ($app) {
            return new GoodsRepository(new Goods);
        });
        
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        //
    }
}
