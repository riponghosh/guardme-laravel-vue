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

Route::group(['prefix' => 'account/support/tickets', 'namespace' => 'Web', 'middleware' => 'auth'], function () {
    Route::get('/', 'TicketController@index')->name('ticket.index');

    Route::get('/create', 'TicketController@create')->name('ticket.create');

    Route::post('/', 'TicketController@store')->name('ticket.store');

    Route::get('/{id}', 'TicketController@show')->where('id', '[0-9]+')
        ->name('ticket.show');

    Route::put('/{id}', 'TicketController@update')->where('id', '[0-9]+')
        ->name('ticket.update');

    Route::post('/{id}/messages', 'MessageController@store')->where('id', '[0-9]+')
        ->name('tickets.messages.store');
});
