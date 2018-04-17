<?php

namespace Modules\App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use Modules\App\Http\Resources\CategoryResource;
use Modules\App\Http\Resources\CitiesResource;
use Modules\App\Http\Resources\CountiesResource;
use Modules\App\Http\Resources\SectorResource;
use Modules\App\Models\Category;
use Modules\App\Models\City;
use Modules\App\Models\County;
use Modules\App\Models\Sector;

class AppController extends Controller
{
    public function getCounties()
    {
        return CountiesResource::collection(County::all());
    }

    public function getCities($county_id)
    {
        return CitiesResource::collection(City::where('county_id', $county_id)->get());
    }

    public function getCategories()
    {
        return CategoryResource::collection(Category::all());
    }

    public function getSectors()
    {
        return SectorResource::collection(Sector::all());
    }

    public function getBroadcastsConfig()
    {
        return config('guardme.broadcasts');
    }
}
