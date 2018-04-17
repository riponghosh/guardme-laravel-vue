<?php

Route::group(['prefix' => 'confirm'], function () {
    // TODO: Delete after testing.
    Route::get('/code', function () {
        return auth()->user()->getOTP();
    });

    Route::get('/phone', 'Web\VerificationController@phone');
    Route::get('/email', 'Web\VerificationController@email');
    Route::get('/resend', 'Web\VerificationController@resend');
    Route::get('/email/{key}', 'Web\VerificationController@confirmEmail');
    Route::get('/confirmChange/{key}', 'Web\VerificationController@confirmChange');
});
