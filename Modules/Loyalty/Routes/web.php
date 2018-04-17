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

Route::group(['prefix' => 'loyalty', 'namespace' => 'Web', 'middleware' => 'auth'], function () {
    Route::get('/', 'LoyaltyController@index')->name('loyalty.index');
    Route::get('/insertReferralCode', 'LoyaltyController@insertReferralCode')->name('loyalty.insertReferralCode');
    Route::get('/credit-history', 'LoyaltyController@creditHistory')->name('loyalty.creditHistory');
    Route::get('/redeem-credit', 'LoyaltyController@redeemCredit')->name('loyalty.redeemCredit');
    Route::get('/redeem-credit/{id}', 'LoyaltyController@getRedeemCreditById')->name('loyalty.getRedeemCreditById');
    Route::post('/redeem-credit', 'LoyaltyController@submitRedeemCredit')->name('loyalty.submitRedeemCredit');
    Route::get('/getRandom4', 'LoyaltyController@getRandom4')->name('loyalty.getRandom4');
});