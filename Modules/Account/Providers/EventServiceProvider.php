<?php

namespace Modules\Account\Providers;

use Illuminate\Support\Facades\Event;
use Illuminate\Foundation\Support\Providers\EventServiceProvider as ServiceProvider;
use Modules\Account\Events\UserHasBeenSetup;
use Modules\Account\Events\UserHasRegistered;
use Modules\Account\Jobs\SendWelcomeMail;
use Modules\Account\Jobs\SetupUser;
use Modules\Account\Listeners\SendWelcomeMessageOnRegistration;
use Modules\Account\Listeners\SetupUserRoleOnRegistration;

class EventServiceProvider extends ServiceProvider
{
    /**
     * The event listener mappings for the application.
     *
     * @var array
     */
    protected $listen = [
        UserHasRegistered::class => [
            SetupUserRoleOnRegistration::class,
        ],
        UserHasBeenSetup::class => [
            SendWelcomeMessageOnRegistration::class
        ]
    ];

    /**
     * Register any events for your application.
     *
     * @return void
     */
    public function boot()
    {
        parent::boot();

        //
    }
}
