<?php
/**
 * Created by PhpStorm.
 * User: Dennis
 * Date: 07/08/2017
 * Time: 03:08 PM
 */

namespace Modules\Account\Repositories;


use Illuminate\Http\Request;
use Modules\Account\Events\UserHasRegisteredFromFacebook;
use Modules\Servermessenger\Messenger\Task\TaskProducer;
use Modules\Users\Events\FacebookUserConnect;
use Modules\Users\Models\User;

class SocialAuthRepository
{
    /**
     * @var AccountRepository
     */
    private $accountRepository;

    /**
     * SocialAuthRepository constructor.
     * @param AccountRepository $accountRepository
     */
    public function __construct(AccountRepository $accountRepository)
    {
        $this->accountRepository = $accountRepository;
    }

    public function initFacebookUser(Request $request)
    {
        $shouldBroadcastEvent = false;
        $password = date('Ymd');

        /**
         * @var User $user
         */
        $user = User::firstOrNew([
            'fb_id' => $request->get('id')
        ]);

        if($user->id){
            // existing ts user
        } else {
            // todo:: create a new user account
            $shouldBroadcastEvent = true;

            $user = $this->accountRepository->register([
                'registered_date' => date('Y-m-d'),
                'username' => str_slug($request->get('name'),'.'),
                'email' => $request->has('email') ? $request->get('email') : null,
                'api_token' => str_random(60),
                'password' => bcrypt($password),
                'fb_id' => $request->get('id')
            ]);
        }

        if($shouldBroadcastEvent){
            // todo:: fire event when no user id is present (ie a new user)
            TaskProducer::publish(new UserHasRegisteredFromFacebook($user, $request->all()));
        }

        return User::find($user->id);
    }

    public function initTwitterUser($twitterDetails)
    {
        $password = date('Ymd');

        /**
         * @var User $user
         */
        $user = User::firstOrNew([
            'twit_id' => $twitterDetails->id
        ]);

        if($user->id){
            // existing ts user
        } else {

            $user = $this->accountRepository->register([
                'registered_date' => date('Y-m-d'),
                'username' => str_slug($twitterDetails->name,'.'),
                'email' => isset($twitterDetails->email) ? $twitterDetails->email : null,
                'api_token' => str_random(60),
                'password' => bcrypt($password),
                'twit_id' => $twitterDetails->id
            ]);
        }

        return User::find($user->id);
    }


}