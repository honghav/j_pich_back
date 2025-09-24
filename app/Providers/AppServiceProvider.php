<?php

namespace App\Providers;

use App\Repositories\AnotherPaysRepositories;
use App\Repositories\CategoriesRepositories;
use App\Repositories\OrdersRepositories;
use App\Repositories\ProductImagesRepositories;
use App\Repositories\ProductsRepositories;
use App\Repositories\Interface\AnotherPaysRepositoriesInterface;
use App\Repositories\Interface\CategoriesRepositoriesInterface;
use App\Repositories\Interface\OrdersRepositoriesInterface;
use App\Repositories\Interface\ProductImagesRepositoriesInterface;
use App\Repositories\Interface\ProductsRepositoriesInterface;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        //
        $this->app->bind(CategoriesRepositoriesInterface::class, CategoriesRepositories::class);
        $this->app->bind(ProductsRepositoriesInterface::class, ProductsRepositories::class);
        $this->app->bind(OrdersRepositoriesInterface::class, OrdersRepositories::class);
        $this->app->bind(AnotherPaysRepositoriesInterface::class, AnotherPaysRepositories::class);
        $this->app->bind(ProductImagesRepositoriesInterface::class, ProductImagesRepositories::class);
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        //
    }
}
