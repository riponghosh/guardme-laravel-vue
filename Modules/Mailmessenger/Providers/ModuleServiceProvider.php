<?php

namespace Modules\Mailmessenger\Providers;

use Caffeinated\Modules\Support\ServiceProvider;

class ModuleServiceProvider extends ServiceProvider
{
    /**
     * Bootstrap the module services.
     *
     * @return void
     */
    public function boot()
    {
        $this->loadTranslationsFrom(__DIR__.'/../Resources/Lang', 'mailmessenger');
        $this->loadViewsFrom(__DIR__.'/../Resources/Views', 'mailmessenger');
        $this->loadMigrationsFrom(__DIR__.'/../Database/Migrations', 'mailmessenger');
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
