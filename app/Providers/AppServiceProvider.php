<?php

namespace App\Providers;

use App\Http\Middleware\RoleMiddleware;
use App\Http\Middleware\VerifyRouteAccess;
use App\Providers\Views\BladeStatements;
use App\Services\Cart\Repositories\CartRepositoryInterface;
use App\Services\Cart\Repositories\CartSessionRepository;
use Illuminate\Pagination\Paginator;
use Illuminate\Support\ServiceProvider;

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
        if ($this->app->isLocal()) {
            $this->app->register(\Barryvdh\LaravelIdeHelper\IdeHelperServiceProvider::class);
        }
    }

    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        $this->bootBladeStatements();

        $this->registerBindings()
            ->registerPagination()
            ->registerObservers()
            ->registerGateAbilities()
            ->registerMiddleware();

    }

    private function registerBindings()
    {
        $this->app->bind(CartRepositoryInterface::class, CartSessionRepository::class);

        return $this;
    }

    private function registerPagination()
    {
        Paginator::defaultView('front.blocks.pagination');
        Paginator::defaultSimpleView('front.blocks.pagination');

        //NOTE  можно сделать так , или в каждом paginate настраивать как надо. Использовал второй вариант.
        // как по мне ето более гибко
        //@link https://github.com/laravel/framework/issues/19441

//        $this->app->resolving(LengthAwarePaginator::class, static function (LengthAwarePaginator $paginator) {
//            return $paginator->appends(request()->query());
//        });
//        $this->app->resolving(Paginator::class, static function (Paginator $paginator) {
//            return $paginator->appends(request()->query());
//        });

        return $this;
    }

    /**
     *  register  Observers
     */
    private function registerObservers()
    {
        \App\Models\Order::observe(\App\Observers\OrderObserver::class);

        return $this;
    }

    /**
     *  Register  new gate
     */
    private function registerGateAbilities()
    {
        \Illuminate\Support\Facades\Gate::define('access-route', function ($user, $route) {
            return $user->hasRouteAccess($route);
        });

        return $this;
    }

    /**
     * register middleware
     */
    private function registerMiddleware()
    {
        $this->app['router']
            ->aliasMiddleware('role', RoleMiddleware::class);

        $this->app['router']
            ->aliasMiddleware('verify-route-access', VerifyRouteAccess::class);

        return $this;

    }
}
