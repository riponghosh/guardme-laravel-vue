<?php

Route::group(['prefix' => 'users'], function () {
    Route::post('init', 'Api\UserController@init');
    Route::post('bulk', 'Api\UserController@bulk');
    Route::post('filter', 'Api\UserController@filter');
});
