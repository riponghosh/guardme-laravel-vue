<?php

use Illuminate\Http\Request;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your module. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::group(['prefix' => 'app'], function (){
    Route::get('counties', 'AppController@getCounties');
    Route::get('counties/{county_id}/cities', 'AppController@getCities');
    Route::get('categories', 'AppController@getCategories');
    Route::get('sectors', 'AppController@getSectors');
    Route::get('broadcasts-config', 'AppController@getBroadcastsConfig');
});
