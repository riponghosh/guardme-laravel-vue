<?php

namespace Modules\Profile\Traits;

use \Modules\Users\Models\User;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Mail;
use App\Mail\CloseAccountRequest;
trait ProfileTrait
{
    /**
     * @param $request
     * @return mixed
     */
    private function updateProfile($request)
    {
        $user_id = auth()->user()->id;
        $errors = $this->validateProfile($request, $user_id);
        if (!$errors) {
            $data = $request->all();

            if ($user_id == $data['id']) {
                $userObj = User::find($user_id);
                if (!empty($data['dob'])) {
                    $userObj->dob = $data['dob'];
                }
                if (!empty($data['phone_number'])) {
                    $userObj->phone_number = $data['phone_number'];
                }
                if (!empty($data['address'])) {
                    $userObj->address = $data['address'];
                }
                if (!empty($data['username'])) {
                    $userObj->username = $data['username'];
                }
                if (!empty($data['email'])) {
                    $userObj->email = $data['email'];
                }
                if (!empty($data['password'])) {
                    $userObj->password = bcrypt($data['password']);
                }
                if (!empty($data['category_id'])) {
                    $userObj->category_id = $data['category_id'];
                }
                if (!empty($data['country_id'])) {
                    $userObj->country_id = $data['country_id'];
                }
                if (!empty($data['city_id'])) {
                    $userObj->city_id = $data['city_id'];
                }
                $userObj->save();
            }
        }
        return $errors;
    }

    /**
     * @return null
     */
    private function getProfile()
    {
        $user = null;
        $user_id = auth()->user()->id;
        if ($user_id) {
            // get user data
            $user =  DB::table('users')
                ->select(
                    'users.id',
                    'users.username',
                    'users.email',
                    'users.api_token',
                    'users.dob',
                    'users.address',
                    'users.phone',
                    'users.profile_picture',
                    'users.security_badge',
                    'users.proof_of_work',
                    'users.visa',
                    'users.category_id',
                    'users.country_id',
                    'users.city_id',
                    'roles.name as role_name'
                )
                ->where('users.id', $user_id)
                ->join('user_roles', 'users.id', '=', 'user_roles.user_id')
                ->join('roles', 'roles.id', '=', 'user_roles.role_id')
                ->first();
            if (!empty($user->profile_picture)) {
                $url = Storage::url('profile-pictures/'. $user->profile_picture);
                $user->profile_picture = $url;
            }
            $user->countries = \Modules\App\Models\County::all();
            $user->cities = $user->country_id ? \Modules\App\Models\City::where('county_id', $user->country_id)->get() : [];
        }
        return $user;

    }

    /**
     * @param $request
     * @param $id
     * @return mixed
     */
    private function validateProfile($request, $id)
    {
        $rule = [
            'id' => 'required|max:11|unique:users,id,' .$id,
            'username' => 'required|max:25|unique:users,username,' .$id,
            'email' => 'required|email|max:90|unique:users,email,'.$id,
            'api_token' => 'required',
            'dob' => 'nullable|date',
            'phone_number' => 'nullable',
            'address' => 'nullable',
            'category_id' => 'nullable|exists:categories,id'
        ];

        $errors = Validator::make($request->all(), $rule)->errors()->messages();

        return $errors;
    }

    /**
     * @param $request
     * @return array
     */
    private function profileCloseRequest($request) {
        $errors = [];
        $user = auth()->user();
        $data = $request->all();
        $data['email'] = $user->email;
        if ($user->api_token == $data['api_token']) {
            Mail::to('feedback@guarddme.com')
                ->send(new CloseAccountRequest($data));
        }
        return $errors;
    }

    private function getUsers($filters = [])
    {
        $users = [];

        foreach (User::filter($filters)->get() as $user) {
            $users[] = [
                'id' => $user->id,
                'email' => $user->email,
                'registered_date' => $user->registered_date->toDateString(),
                'status' => $user->status
            ];
        }

        return $users;
    }

}
