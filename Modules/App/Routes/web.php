<?php

Route::group(['prefix' => '/'], function () {
    Route::get('/', 'HomeController@home');
    Route::view('congratulations', 'app::pages.congratulations');

    Route::get('/jobs', 'JobController@findJobPage');
    Route::get('/jobs/details', 'JobController@jobDetailsPage');
    Route::get('/jobs/new', 'JobController@newJobPage');

    Route::get('/personnel', 'PersonnelController@getPersonnelListingPage');
});
