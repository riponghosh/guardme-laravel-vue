<?php

namespace Modules\UserMessenger\Providers;

use Caffeinated\Modules\Support\ServiceProvider;
use Modules\UserMessenger\Contracts\SMSProviderContract;
use Modules\UserMessenger\Wrappers\TwilioServiceWrapper;

class ModuleServiceProvider extends ServiceProvider
{
    /**
     * Bootstrap the module services.
     *
     * @return void
     */
    public function boot()
    {
        $this->loadMigrationsFrom(__DIR__.'/../Database/Migrations');
        $this->loadViewsFrom(__DIR__.'/../Resources/Views', 'usermessenger');
        $this->loadTranslationsFrom(__DIR__.'/../Resources/Lang', 'usermessenger');
    }

    /**
     * Register the module services.
     *
     * @return void
     */
    public function register()
    {
        $this->app->register(RouteServiceProvider::class);

        $this->app->singleton(SMSProviderContract::class, function () {
            return new TwilioServiceWrapper(config('services.twilio'));
        });
    }
}
