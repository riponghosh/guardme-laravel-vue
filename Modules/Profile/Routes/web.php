<?php

Route::group(['prefix' => 'account/profile','namespace' => 'Web', 'middleware' => ['auth']], function () {

    Route::get('/', 'ProfileController@index');
    Route::get('/verification', 'ProfileController@verification');
    Route::get('/gotoemployer', 'ProfileController@switchToEmployer');
    Route::get('/gotosecurity', 'ProfileController@switchToSecurity');
    Route::get('/delete', 'ProfileController@deleteRequest');
    Route::get('/users/{type?}', 'ProfileController@users');
    Route::get('/{user}', 'ProfileController@show');
    Route::get('/docs/{filename}', 'ProfileController@getVerificationDocument');
});
