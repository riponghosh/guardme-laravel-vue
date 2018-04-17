<?php

namespace Modules\Profile\Http\Controllers\Api;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use App\Mail\UserApprovedMail;
use App\Mail\UserDisapprovedMail;
use Modules\Users\Models\User;
use Modules\Profile\Traits\ProfileTrait;
use Modules\Profile\Traits\UploadTrait;
use Symfony\Component\HttpFoundation\Response;
use Illuminate\Support\Facades\Mail;

class ProfileController extends Controller
{
    use ProfileTrait, UploadTrait;

    public function getUserProfile()
    {
        return response()->json($this->getProfile());
    }

    public function save(Request $request)
    {
        $errors = $this->updateProfile($request);
        return response()->json([
            'status' => $errors ? 500 : 200,
            'errors' => $errors,
        ]);
    }

    public function uploadProfilePicture(Request $request)
    {
        $errors = $this->saveUploadedProfilePicture($request);
        return response()->json([
           'status' => $errors ? 500 : 200,
            'errors' => $errors
        ]);
    }

    public function uploadVerificationDocument(Request $request)
    {
        $errors = $this->saveUploadedVerificationDocument($request);
        return response()->json([
            'status' => $errors ? 500 : 200,
            'errors' => $errors
        ]);
    }

    public function deleteRequest(Request $request)
    {
        $errors = $this->profileCloseRequest($request);
        return response()->json([
            'status' => $errors ? 500 : 200,
            'errors' => $errors,
        ]);
    }

    public function users($type = null)
    {
        if (!auth()->user()->hasRole('Admin')) {
            return response()->json([
                'status' => 500,
                'errors' => ['Access denied']
            ]);
        }

        $filters = $type == null ? ['notSuspended', 'security'] : [$type];

        if (request()->isMethod('post')) {
            $filter = request()->get('filter');

            switch ($filter) {
                case 'all':
                    $filters = array_merge($filters, []);
                break;
                case 'new':
                    $filters = array_merge($filters, [
                        'between' => request()->only(['date_from', 'date_to'])
                    ]);
                break;
                case 'verified':
                    $filters = array_merge($filters, ['verified']);
                break;
                case 'unverified':
                    $filters = array_merge($filters, ['unverified']);
                break;
                case 'category':
                    $filters = array_merge($filters, ['category' => [request()->get('category_id')]]);
                break;
                case 'city':
                    $country_id = request()->get('country_id');

                    $city_id = request()->get('city_id');

                    if ($country_id) {
                        $filters = array_merge($filters, ['country' => [$country_id]]);
                    }

                    if ($city_id) {
                        $filters = array_merge($filters, ['city' => [$city_id]]);
                    }
                break;
            }
        }

        $users = $this->getUsers($filters);

        return response()->json($users);
    }

    public function approve(User $user)
    {
        if (!auth()->user()->hasRole('Admin')) {
            return response()->json([
                'status' => 500,
                'errors' => ['Access denied']
            ]);
        }

        $user->approve();

        if (request()->get('with_notification')) {
            Mail::to($user->email)->send(new UserApprovedMail());
        }

        return response()->json([
            'status' => 200,
            'user' => [
                'id' => $user->id,
                'status' => $user->status
            ]
        ]);
    }

    public function disapprove(User $user)
    {
        if (!auth()->user()->hasRole('Admin')) {
            return response()->json([
                'status' => 500,
                'errors' => ['Access denied']
            ]);
        }

        $user->disapprove();

        if (request()->get('with_notification')) {
            Mail::to($user->email)->send(new UserDisapprovedMail(request()->only(['title', 'body'])));
        }

        return response()->json([
            'status' => 200,
            'user' => [
                'id' => $user->id,
                'status' => $user->status
            ]
        ]);
    }

    public function suspend(User $user)
    {
        if (!auth()->user()->hasRole('Admin')) {
            return response()->json([
                'status' => 500,
                'errors' => ['Access denied']
            ]);
        }

        $user->suspend();

        return response()->json([
            'status' => 200,
            'user' => [
                'id' => $user->id,
                'status' => $user->status
            ]
        ]);
    }
}
