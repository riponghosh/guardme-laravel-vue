<?php
/**
 * Created by PhpStorm.
 * User: Dennis
 * Date: 07/12/2017
 * Time: 09:32 AM
 */

namespace Modules\Account\Events;


use Modules\Users\Models\User;

class UserHasRegisteredFromFacebook
{
    /**
     * @var User
     */
    public $user;
    /**
     * @var array
     */
    public $payload;


    /**
     * UserHasRegisteredFromFacebook constructor.
     * @param User $user
     * @param array $payload
     */
    public function __construct(User $user, array $payload)
    {
        $this->user = $user;
        $this->payload = $payload;
    }
}