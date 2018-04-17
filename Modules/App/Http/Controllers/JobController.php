<?php

namespace Modules\App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;

class JobController extends Controller
{
    public function findJobPage()
    {
        return view('app::pages.jobs.jobs');
    }

    public function jobDetailsPage()
    {
        return view('app::pages.jobs.details');
    }

    public function newJobPage()
    {
        return view('jobs::create');
    }
}
