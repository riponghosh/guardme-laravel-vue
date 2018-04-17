<?php

Route::redirect('/account', '/account/dashboard', 301);

Route::group(['prefix' => 'account/dashboard', 'middleware' => ['auth']], function () {

    Route::get('/', 'DashboardController@dashboard');
});
