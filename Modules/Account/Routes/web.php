<?php

Route::view('/signup', 'account::auth.register');

Route::group(['prefix' => 'account'], function () {
    Route::view('/login', 'account::auth.login');
    Route::post('login', 'LoginController@login');

    Route::get('logout', 'LoginController@logout');

    Route::post('register', 'RegisterController@register');

});
