<?php

namespace Modules\App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;

class PersonnelController extends Controller
{
    public function getPersonnelListingPage()
    {
        return view('app::pages.sia-personnel');
    }
}
