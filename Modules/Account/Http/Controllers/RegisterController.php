<?php

namespace Modules\Account\Http\Controllers;


use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use Modules\Account\Jobs\Register;
use Modules\Account\Repositories\AccountRepository;
use Modules\Users\Http\Resources\UserAccountResource;
use Modules\Users\Models\User;
use Carbon\Carbon;

class RegisterController extends Controller
{

    public function __construct()
    {

    }


    public function registerView()
    {
        return view('app::pages.register');
    }

    public function register()
    {
        $data = $this->validate(\request(), [
            'email' => 'required|email|unique:users',
            'password' => 'required|same:retype_password',
            'isEmployer' => 'required',
            //'company' => 'required_if:isEmployer,true',
        ]);

        $company = request()->get('company') ?? null;

        if($company) $data['company'] = $company;

        $data['referrer_id'] = optional(User::where('referral_code', request()->get('referral_code'))->first())->id;

        publish(new Register($data));

        if(\request()->ajax()){
            return response()->json([
                'message' => 'Registration successful.'
            ]);
        }
    }

    public function validateUser(Request $request, User $user, AccountRepository $accountRepository)
    {
        $data = $request->validate([
            'username' => 'required|unique:users|max:48',
            'email' => 'required',
            'password' => 'required|confirmed',
        ]);

        $user = $accountRepository->register($data);

        if($request->ajax()){
            return response()->json([
                'user' => $user,
                'message' => 'Registration successful.'
            ]);
        }

        return $user;
    }







}
