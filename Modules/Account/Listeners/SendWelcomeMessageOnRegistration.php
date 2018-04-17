<?php
/**
 * Created by PhpStorm.
 * User: Dennis
 * Date: 23/01/2018
 * Time: 09:20 AM
 */

namespace Modules\Account\Listeners;


use Modules\Account\Events\UserHasBeenSetup;
use Modules\Account\Jobs\SendWelcomeMail;

class SendWelcomeMessageOnRegistration
{
    public function handle(UserHasBeenSetup $event)
    {
        publish(new SendWelcomeMail($event->user->id));
    }

}