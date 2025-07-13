<?php

namespace App\Providers;

use App\Http\Middleware\IsAdminMiddleware;
use App\Interfaces\AuthInterface;
use App\Interfaces\OrderInterface;
use App\Interfaces\ProductInterface;
use App\Services\AuthService;
use App\Services\OrderService;
use App\Services\ProductService;
use Illuminate\Routing\Router;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    public function register(): void
    {
        $this->app->bind(AuthInterface::class, AuthService::class);

        $this->app->bind(ProductInterface::class, ProductService::class);

        $this->app->bind(OrderInterface::class, OrderService::class);


    }

    public function boot(Router $router): void
    {
        $router->aliasMiddleware('admin', IsAdminMiddleware::class);
    }
}
