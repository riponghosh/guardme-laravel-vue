<?php

namespace Modules\Dashboard\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use Modules\Users\Models\User;

class DashboardController extends Controller
{
    public function dashboard()
    {
        return $this->getUserDashboard();
    }

    private function getUserDashboard()
    {
        /**
         * @var User $user
         */
        $user = auth()->user();

        if($user){
            $role = $user->getPrimaryRole();

            $view = 'dashboard::dashboard.' . str_slug($role->name);

            return view($view);
        }

        return ;
    }
}
