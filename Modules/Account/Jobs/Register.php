<?php
/**
 * Created by PhpStorm.
 * User: Dennis
 * Date: 15/01/2018
 * Time: 02:00 PM
 */

namespace Modules\Account\Jobs;


use Modules\Account\Events\UserHasRegistered;
use Modules\Users\Models\User;

class Register
{
    /**
     * @var array
     */
    private $data;


    /**
     * Register constructor.
     * @param array $data
     */
    public function __construct(array $data)
    {
        $this->data = $data;
    }

    public function handle()
    {
        /**
         * @var User $user
         */
        $user = User::firstOrNew([
            'id' => $payload['id'] ?? null
        ]);

        $user->fill([
            'password' => bcrypt($this->data['password']),
            'registered_date' => date('Y-m-d'),
            'username' => isset($this->data['username']) ?
                str_slug($this->data['username'],'.') :
                $this->pickUsernameFromEmail($this->data['email']),
            'email' => $this->data['email'],
            'api_token' => str_random(60),
            'fb_id' => $this->data['fb_id'] ?? null,
            'twit_id' => $this->data['twit_id'] ?? null,
            'referrer_id' => $this->data['referrer_id'] ?? null,
            'referral_code' => $this->generateRandom4()
        ]);

        $user->save();

        publish(new UserHasRegistered($user, $this->data));

        return $user;
    }

    private function pickUsernameFromEmail($email)
    {
        return explode('@',$email)[0];

    }

    private function generateRandom4()
    {
        $number = "";
        for ($i = 0; $i < 4; $i++) {
            $min = ($i == 0) ? 1 : 0;
            $number .= mt_rand($min, 9);
        }

        $count = User::where('referral_code', $number)->get()->count();
        if($count > 0) $this->generateRandom4();

        return $number;
    }
}