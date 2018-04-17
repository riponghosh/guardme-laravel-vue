<?php

namespace Modules\Profile\Http\Controllers\Web;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use Modules\Users\Models\User;
use Modules\Profile\Traits\ProfileTrait;
use Modules\App\Models\Category;
use Modules\App\Models\County;
use Modules\Account\Models\Role;
use Storage;
use File;


class ProfileController extends Controller
{
    use ProfileTrait;

    public function index()
    {
        return $this->getUserProfilePage();
    }

    public function verification()
    {
        $user = auth()->user();
        $is_employer = $user->inRoles(['Employer']);
        if ($is_employer) {
            abort(404);
        }

        return view('profile::profile.verification');
    }

    public function deleteRequest()
    {
        return view('profile::profile.delete-request');
    }

    private function getUserProfilePage()
    {
        if (!auth()->user()) {
            abort(404);
        }

        $cities = [];

        if (auth()->user()->country_id) {
            $cities = County::findOrFail(auth()->user()->country_id)->cities;
        }

        return view('profile::profile.full-profile', ['categories' => Category::all(), 'countries' => County::all(), 'cities' => $cities]);
    }

    public function store()
    {
    }

    public function users($type = null)
    {
        if (!auth()->user()->hasRole('Admin')) {
            abort(404);
        }

        $view = $type == null ? 'profile.users' : 'profile.' . $type;

        $data = [];

        $data['countries'] = \Modules\App\Models\County::all();

        if ($type == 'employers') {
            $data['categories'] = Category::all();
        }

        return view("profile::{$view}", $data);
    }

    public function show(User $user)
    {
        if (!auth()->user()->hasRole('Admin') || !$user) {
            abort(404);
        }

        return view('profile::profile.user-profile', ['user' => $user]);
    }

    public function getVerificationDocument($filename)
    {
        $path = storage_path('app/public/verification-documents/' . $filename);

        if (!File::exists($path)) {
            abort(404);
        }

        return response()->file($path);

        return response()->file($path, ["Content-Type" => File::mimeType($path)]);
    }

    public function switchToEmployer()
    {
        auth()
            ->user()
            ->roles()
            ->sync([
                Role::where('name', 'Employer')->first()->id => ['is_primary' => 1]
            ]);

        return redirect()->back();
    }

    public function switchToSecurity()
    {
        auth()
            ->user()
            ->roles()
            ->sync([
                Role::where('name', 'Job Seeker')->first()->id => ['is_primary' => 1]
            ]);

        return redirect()->back();
    }
}
