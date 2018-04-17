<?php
/**
 * Created by PhpStorm.
 * User: Dennis
 * Date: 11/02/2018
 * Time: 05:21 PM
 */

namespace Modules\Company\Listeners;


use Modules\Account\Events\UserHasRegistered;
use Modules\Company\Jobs\CreateCompany;
use Modules\Users\Models\User;

class SetupCompanyOnRegistration
{
    public function handle(UserHasRegistered $event)
    {
        /** @var User $user */
        $user = $event->user;

        if($user->hasRole(config('guardme.acl.Employer')))
        publish(new CreateCompany($event->user, $event->payload));
    }

}