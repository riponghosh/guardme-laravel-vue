<?php

namespace Modules\UserMessenger\Http\Controllers\Web;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Modules\Account\Jobs\SendWelcomeMail;
use Modules\UserMessenger\Channels\SMS;
use Modules\Users\Repositories\UsersRepository;

class VerificationController extends Controller
{
    /**
     * Confirm the e-mail address.
     *
     * @param $key
     *
     * @return \Illuminate\Http\RedirectResponse|\Illuminate\Routing\Redirector
     */
    public function confirmEmail($key)
    {
        $id = str_before($key, ':');

        $user = app(UsersRepository::class)->getUserById($id);

        if ($user && str_after($key, ':') == $user->confirmation_code)
        {
            $user->email_verified = true;
            $user->save();
        }

        return redirect('/account/dashboard');
    }

    /**
     * Change email address.
     *
     * @param $key
     *
     * @return \Illuminate\Http\RedirectResponse|\Illuminate\Http\JsonResponse
     */
    public function confirmChange($key)
    {
        list($id, $code, $new) = explode(':', $key);

        $user = app(UsersRepository::class)->getUserById($id);

        if ($user->confirmation_code === $code)
        {
            $user->email          = $new;
            $user->email_verified = false;
            $user->save();

            publish(new SendWelcomeMail($user->id, 'Confirm your new email'));
        }

        return redirect('/account/dashboard');
    }

    /**
     * Resend the confirmation email.
     *
     * @param Request $request
     *
     * @return \Illuminate\Http\RedirectResponse|\Illuminate\Routing\Redirector
     */
    public function resend(Request $request)
    {
        publish(new SendWelcomeMail($request->user()->id));

        return redirect('/account');
    }

    /**
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function phone()
    {
        return view('usermessenger::phone');
    }

    /**
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function email()
    {
        return view('usermessenger::email');
    }
}
