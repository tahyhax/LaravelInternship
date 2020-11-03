<?php

namespace App\Providers;

use App\Services\Cart\Repositories\CartRepositoryInterface;
use App\Services\Cart\Repositories\CartSessionRepository;
use Illuminate\Pagination\Paginator;
use Illuminate\Support\ServiceProvider;
use App\Providers\Views\BladeStatements;

class AppServiceProvider extends ServiceProvider
{
    use BladeStatements;

    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {

    }

    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        $this->bootBladeStatements();
        $this->registerBindings();
        $this->registerPagination();

    }

    private function registerBindings()
    {
        $this->app->bind(CartRepositoryInterface::class, CartSessionRepository::class);
    }

    private function registerPagination()
    {
        Paginator::defaultView('front.blocks.pagination');
        Paginator::defaultSimpleView('front.blocks.pagination');
    }
}
