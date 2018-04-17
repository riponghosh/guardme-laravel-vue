<?php

Route::group(['prefix' => 'account/support/tickets', 'namespace' => 'Api', 'middleware' => 'auth:api'], function() {
    Route::get('/', 'TicketController@index');

    Route::post('/', 'TicketController@store');

    Route::get('/{id}', 'TicketController@show')->where('id', '[0-9]+');

    Route::put('/{id}', 'TicketController@update')->where('id', '[0-9]+');

    Route::post('/{id}/messages', 'MessageController@store')->where('id', '[0-9]+');
});
