<?php

namespace App\Providers;

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

        Paginator::defaultView('front.blocks.pagination');

        Paginator::defaultSimpleView('front.blocks.pagination');
    }
}
