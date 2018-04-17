<?php

Route::group(['prefix' => 'verify'], function () {
    Route::post('/otp', 'Api\VerificationController@otp');
    Route::post('/confirm', 'Api\VerificationController@confirm');

    Route::post('/change', 'Api\VerificationController@change');
});