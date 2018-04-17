<?php
/**
 * Created by PhpStorm.
 * User: Dennis
 * Date: 22/01/2018
 * Time: 10:14 PM
 */

namespace Modules\Account\Jobs;


use Modules\Account\Events\UserHasBeenSetup;
use Modules\Account\Events\UserHasRegistered;
use Modules\Account\Models\Role;
use Modules\Users\Models\User;

class SetupUser
{
    /**
     * @var User
     */
    private $user;
    /**
     * @var array
     */
    private $data;

    /**
     * SetupUserRole constructor.
     * @param User $user
     * @param array $data
     */
    public function __construct(User $user, array $data)
    {
        $this->user = $user;
        $this->data = $data;
    }

    public function handle()
    {

        if($this->data['isEmployer']){
            $this->user->roles()->attach(
                [Role::whereName(config('guardme.acl.Employer'))->first()->id => ['is_primary' => true]]
            );
        } else {
            $this->user->roles()->attach(
                [Role::whereName(config('guardme.acl.Job_Seeker'))->first()->id => ['is_primary' => true]]
            );
        }

        publish(new UserHasBeenSetup($this->user));
    }

}