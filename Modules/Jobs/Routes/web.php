<?php

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| This file is where you may define all of the routes that are handled
| by your module. Just tell Laravel the URIs it should respond
| to using a Closure or controller method. Build something great!
|
*/

Route::group(['prefix' => 'jobs', 'middleware' => 'auth'], function () {
    Route::get('/new', 'JobsController@newJobPage');
    Route::get('{job_slug}/payment', 'JobPaymentController@jobPaymentPage');
});

Route::group(['prefix' => 'account/jobs', 'middleware' => 'auth'], function () {
    Route::get('/schedule', 'JobsController@schedule');
    Route::get('/schedule/{jobSlug}', 'JobsController@manageJobDetails');
});


Route::get('/jobs', 'JobsController@showJobListings');
Route::get('/jobs/{jobSlug}', 'JobsController@showJobDetails');