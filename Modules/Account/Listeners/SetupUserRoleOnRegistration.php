<?php
/**
 * Created by PhpStorm.
 * User: Dennis
 * Date: 23/01/2018
 * Time: 09:20 AM
 */

namespace Modules\Account\Listeners;


use Modules\Account\Events\UserHasRegistered;
use Modules\Account\Jobs\SetupUser;

class SetupUserRoleOnRegistration
{
    public function handle(UserHasRegistered $event)
    {
        publish(new SetupUser($event->user, $event->payload));
    }

}