<?php
/**
 * Created by PhpStorm.
 * User: Dennis
 * Date: 09/10/2017
 * Time: 04:12 PM
 */

namespace Modules\Account\Repositories;


use Modules\Account\Events\UserHasRegistered;
use Modules\Account\Jobs\Register;
use Modules\Servermessenger\Messenger\Task\TaskProducer;
use Modules\Users\Models\User;

class AccountRepository
{
    /**
     * @var User
     */
    private $user;


    /**
     * AccountRepository constructor.
     * @param User $user
     */
    public function __construct(User $user)
    {
        $this->user = $user;
    }

    public function register(array $payload)
    {
        /**
         * @var User $user
         */
        $user = User::firstOrNew([
            'id' => $payload['id'] ?? null
        ]);

        $user->fill([
            'password' => bcrypt($payload['password']),
            'registered_date' => date('Y-m-d'),
            'username' => str_slug($payload['username'],'.'),
            'email' => $payload['email'],
            'api_token' => str_random(60),
            'fb_id' => $payload['fb_id'] ?? null,
            'twit_id' => $payload['twit_id'] ?? null,
        ]);

        $user->save();

        TaskProducer::publish(new UserHasRegistered($user, $payload));

        return $user;
    }

    /**
     * @param $email
     * @param bool $createNewIfNull
     * @return User
     */
    public function getAccountByEmail($email, $createNewIfNull = false)
    {
        $user = $this->user->where('email', $email)->first();

        if(!$user && $createNewIfNull) {
            $user = dispatch_now(new Register([
                'email' => $email,
                'password' => str_random(7)
            ]));


        }

        return $user;
    }
}