<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use App\Repositories\BuyRepository;
use App\Repositories\ProductRepository;
use App\Repositories\PaymentRepository;
use App\Services\BuyService;
use App\Services\ProductService;
use App\Services\PaymentService;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        $this->app->bind(BuyRepository::class, function ($app) {
            return new BuyRepository();
        });

        $this->app->bind(ProductRepository::class, function ($app) {
            return new ProductRepository();
        });

        $this->app->bind(PaymentRepository::class, function ($app) {
            return new PaymentRepository();
        });

        $this->app->bind(BuyService::class, function ($app) {
            return new BuyService($app->make(BuyRepository::class));
        });

        $this->app->bind(ProductService::class, function ($app) {
            return new ProductService($app->make(ProductRepository::class));
        });

        $this->app->bind(PaymentService::class, function ($app) {
            return new PaymentService($app->make(PaymentRepository::class));
        });
    }

    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        //
    }
}
