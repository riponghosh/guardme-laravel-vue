<?php

namespace Modules\Tickets\Providers;

use Caffeinated\Modules\Support\ServiceProvider;

class ModuleServiceProvider extends ServiceProvider
{
    /**
     * Bootstrap the module services.
     *
     * @return void
     */
    public function boot(\Illuminate\Routing\Router $router)
    {
        $router->aliasMiddleware('hasRole', 'Modules\Tickets\Http\Middleware\HasRole');
        $this->loadTranslationsFrom(__DIR__. '/../Resources/Lang', 'tickets');
        $this->loadViewsFrom(__DIR__. '/../Resources/Views', 'tickets');
        $this->loadMigrationsFrom(__DIR__. '/../Database/Migrations', 'tickets');
    }

    /**
     * Register the module services.
     *
     * @return void
     */
    public function register()
    {
        $this->app->register(RouteServiceProvider::class);
    }
}
