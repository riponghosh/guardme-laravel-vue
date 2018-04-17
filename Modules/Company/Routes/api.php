<?php

Route::group(['prefix' => 'companies', 'middleware' => 'auth:api'], function(){
    Route::post('new', 'CompanyController@saveCompany');
    Route::get('auth', 'CompanyController@getAuthUserCompanies');
});
