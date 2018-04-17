<?php

namespace Modules\Users\Http\Controllers\Web;

use App\Http\Controllers\Controller;

class UserController extends Controller
{
    /**
     * Get index page.
     *
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function index()
    {
        return view('users::index');
    }
}
