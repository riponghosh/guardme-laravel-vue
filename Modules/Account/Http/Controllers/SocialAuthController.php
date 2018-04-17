<?php

namespace Modules\Account\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use Laravel\Socialite\Facades\Socialite;
use Modules\Account\Events\UserHasLoggedIn;
use Modules\Account\Http\Resources\UserAccountProfileResource;
use Modules\Account\Jobs\Register;
use Modules\Account\Repositories\AccountRepository;
use Modules\Account\Repositories\SocialAuthRepository;
use Modules\Servermessenger\Messenger\Task\TaskProducer;
use Modules\Users\Http\Resources\UserAccountResource;
use Modules\Users\Models\User;

class SocialAuthController extends Controller
{
    /**
     * @var SocialAuthRepository
     */
    private $socialAuthRepository;

    /**
     * SocialAuthController constructor.
     * @param SocialAuthRepository $socialAuthRepository
     */
    public function __construct(SocialAuthRepository $socialAuthRepository)
    {
        $this->socialAuthRepository = $socialAuthRepository;
    }

    public function checkEmailToLogin(AccountRepository $accountRepository)
    {
        $credentials = \request()->all();

        $user = $accountRepository->getAccountByEmail($credentials['email'],true);

        $user->update([
            'metadata->auth_type' => $credentials['auth_type'] ?? null
        ]);
        /*if($user){
            // todo => user exists. requires further authentication (via password)
            return response()->json([
                'requiresAuth' => true,
                'message' => 'Email exists',
                'user' => new UserAccountResource($user)
            ]);
        }

        // todo => user does not exits. creates a new account and authenticates user
        $user = dispatch_now(new Register([
            'email' => $credentials['email'],
            'password' => str_random(7)
        ]));*/

        return response()->json([
            //'requiresAuth' => true,
            'message' => 'Authenticated',
            'user' => new UserAccountProfileResource($user)
        ]);
    }

    public function facebookLogin()
    {
        // todo:: stores facebook auth user to our db
        /**
         * @var User $user
         */
        $user = $this->socialAuthRepository->initFacebookUser(\request());

        auth()->login($user);

        TaskProducer::publish(new UserHasLoggedIn($user));

        if(\request()->ajax()){
            return response()->json([
                'user' => auth()->user(),
                'message' => 'Successfully logged in',
                'redirect' => $user->requiresInitialSetup() ?
                    '/welcome/intro' :
                    redirect()->intended()->getTargetUrl()
            ]);
        }

        return 'logged in successfully';

    }

    // todo:: twitterLogin method
    public function twitterLogin(){
        return Socialite::driver('twitter')->redirect();
    }

    public function twitterDetail(){
        $twit_user = Socialite::driver('twitter')->user();

        /**
         * @var User $user
         */
        $user = $this->socialAuthRepository->initTwitterUser($twit_user);

        auth()->login($user);

        TaskProducer::publish(new UserHasLoggedIn($user));

        $redirect_path = !$user->requiresInitialSetup() ? redirect()->intended()->getTargetUrl() : '/welcome/intro?setup=account';

        return redirect($redirect_path);

    }
}
