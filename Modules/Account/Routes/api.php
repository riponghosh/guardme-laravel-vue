<?php

Route::group(['prefix'=>'account'], function(){
    Route::any('login', 'LoginController@login');
    Route::post('register', 'RegisterController@register');


    Route::post('auth/social', 'SocialAuthController@checkEmailToLogin');
    Route::post('auth/social/pass', 'LoginController@login');
});
