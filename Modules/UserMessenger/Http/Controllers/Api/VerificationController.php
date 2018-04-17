<?php

namespace Modules\UserMessenger\Http\Controllers\Api;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Modules\UserMessenger\Channels\Email;
use Modules\UserMessenger\Channels\SMS;
use Modules\UserMessenger\Mail\PreparedEmail;
use Modules\Users\Models\User;
use Modules\Users\Repositories\UsersRepository;

class VerificationController extends Controller
{
    /**
     * Return fail response.
     * TODO: Add this in \App\Http\Controllers\Controller
     *
     * @param string $error
     * @param int $code
     *
     * @return \Illuminate\Http\JsonResponse
     */
    protected function fail(string $error, int $code = 500)
    {
        return response()->json(compact('error', 'code'));
    }

    /**
     * Send one time password.
     *
     * @param Request $request
     *
     * @return \Illuminate\Http\RedirectResponse|\Illuminate\Http\JsonResponse
     */
    public function otp(Request $request)
    {
        /**
         * @var SMS $sms
         */
        $user  = auth('api')->user();
        $phone = (string) $request->get('phone');

        if (! $user->phone_verified)
        {
            $isUsed = app(UsersRepository::class)->getUserByPhone($phone);

            if ($isUsed !== null) {
                return $this->fail('This phone is already used in the another GuardMe account');
            }

            $user->phone = $phone;
            $user->save();
        }

        try {
            $sms = app(SMS::class);
            $sms->send($user->phone, 'Your verification code is ' . $user->getOTP());

            return response()->json(['success' => true]);
        } catch (\Exception $exception) {
            if (! $user->phone_verified) {
                $user->phone = null;
                $user->save();
            }
        }

        return $this->fail('Incorrect number');
    }

    /**
     * Confirm phone number.
     *
     * @param Request $request
     *
     * @return \Illuminate\Http\RedirectResponse|\Illuminate\Http\JsonResponse
     */
    public function confirm(Request $request)
    {
        $user = auth('api')->user();

        if ($user->getOTP() != $request->get('code')) {
            return $this->fail('Confirmation code is incorrect or expired');
        }

        if ($user->phone_verified) {
            $user->phone          = null;
            $user->phone_verified = false;
        } else {
            $user->phone_verified = true;
        }
        $user->save();

        return response()->json(['success' => true]);
    }

    /**
     * Send confirmation password to old email.
     *
     * @param Request $request
     *
     * @return \Illuminate\Http\RedirectResponse|\Illuminate\Http\JsonResponse
     */
    public function change(Request $request)
    {
        $user   = auth('api')->user();
        $change = $request->get('change');
        $isUsed = app(UsersRepository::class)->getUserByEmail($change);

        if ($isUsed) {
            return $this->fail('This email is already used in the another GuardMe account');
        }

        /**
         * @var Email $email
         */
        $email = app(Email::class);

        $email->send($user->email, PreparedEmail::class, [
            'usermessenger::emails.unbind', compact('user', 'change'), 'Remove email from GuardMe'
        ]);

        return response('OK');
    }
}
