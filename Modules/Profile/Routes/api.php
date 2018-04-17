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

Route::group(['prefix' => '/account/profile', 'namespace' => 'Api', 'middleware' => 'auth:api'], function() {
    Route::post('/save-profile-data', 'ProfileController@save')->name('profile.save');
    Route::get('/get-user-profile', 'ProfileController@getUserProfile')->name('profile.get');
    Route::post('/upload-profile-picture', 'ProfileController@uploadProfilePicture')->name('profile.upload.picture');
    Route::post('/upload-verification-document', 'ProfileController@uploadVerificationDocument');
    Route::post('/delete-request', 'ProfileController@deleteRequest');
    Route::get('/users/{type?}', 'ProfileController@users');
    Route::post('/users/{type?}', 'ProfileController@users');
    Route::post('/approve/{user}', 'ProfileController@approve');
    Route::post('/disapprove/{user}', 'ProfileController@disapprove');
    Route::get('/suspend/{user}', 'ProfileController@suspend');
});
