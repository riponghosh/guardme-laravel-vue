<?php

namespace Modules\Profile\Traits;

use \Modules\Users\Models\User;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\DB;
trait UploadTrait
{
    /**
     * @param $request
     * @return mixed
     */
    private function saveUploadedProfilePicture($request) {
        $errors = $this->validateProfilePicture($request);
        if (!$errors) {
            $user_id = auth()->user()->id;
            $old_file = $this->getField('profile_picture', $user_id);
            $old_file = !empty($old_file->profile_picture) ? ($old_file->profile_picture) : null;
            if (!empty($old_file)) {
                Storage::delete('public/profile-pictures/'.$old_file);
            }
            $extension = $request->file('profile_picture')->getClientOriginalExtension();
            $path = Storage::putFileAs('public/profile-pictures', $request->file('profile_picture'), 'profile_picture_'.$user_id.'.'.$extension);
            if (!empty($path)) {
                $path = explode('/', $path);
                $path = $path[count($path)-1];
                $userObj = User::find($user_id);
                $userObj->profile_picture = $path;
                $userObj->save();
            }
        }
        return $errors;
    }

    /**
     * @param $request
     * @return mixed
     */
    private function saveUploadedVerificationDocument($request) {
        $field = '';
        if (isset($request->security_badge)) {
            $field = 'security_badge';
        } else if (isset($request->proof_of_work)) {
            $field = 'proof_of_work';
        } else if (isset($request->visa)) {
            $field = 'visa';
        }
        $errors = $this->validateVerificationDocument($request, $field);

        if (!$errors) {
            $user_id = auth()->user()->id;
            $old_file = $this->getField($field, $user_id);
            $old_file = !empty($old_file->$field) ? ($old_file->$field) : null;
            if (!empty($old_file)) {
                Storage::delete('public/verification-documents/'.$old_file);
            }
            $extension = $request->file($field)->getClientOriginalExtension();
            $path = Storage::putFileAs('public/verification-documents', $request->file($field), $field.'_'.$user_id.'.'.$extension);
            if (!empty($path)) {
                $path = explode('/', $path);
                $path = $path[count($path)-1];
                $userObj = User::find($user_id);
                $userObj->$field = $path;
                $userObj->save();
            }
        }
        return $errors;
    }

    /**
     * @param $request
     * @return mixed
     */
    private function validateProfilePicture($request)
    {
        $rule = [
            'profile_picture' => 'required|image|mimes:jpeg,png,jpg,gif|max:2048',
        ];

        $errors = Validator::make($request->all(), $rule)->errors()->messages();

        return $errors;
    }

    /**
     * @param $request
     * @param $field
     * @return mixed
     */
    private function validateVerificationDocument($request, $field)
    {
        $rule = [
            $field => 'required|mimes:jpeg,png,jpg,gif,pdf|max:2048',
        ];

        $errors = Validator::make($request->all(), $rule)->errors()->messages();

        return $errors;
    }

    /**
     * @param $field
     * @param $user_id
     * @return mixed
     */
    private function getField($field, $user_id) {
        $users = DB::table('users')
            ->select($field)
            ->where('id', $user_id)
            ->first();
        return $users;
    }

}

