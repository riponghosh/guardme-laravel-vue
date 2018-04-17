<?php

Route::group(['prefix' => 'jobs', 'middleware' => 'auth:api'], function(){
    Route::post('new', 'JobsController@saveJob');
    Route::get('auth/active', 'JobsController@getAuthUserActiveJobs');

    Route::get('{user_id}/job-profile', 'JobsController@getUserJobProfile');

    Route::post('/{job_id}/apply', 'ApplyController@applyToJob');

    Route::post('/{job_id}/hire', 'HireController@hireUser');

    Route::get('/{job_id}/applicants', 'ApplyController@getJobApplicants');
    Route::get('/{job_id}/employees', 'HireController@getJobEmployees');

    Route::get('/{job_id}/mark-complete', 'JobsController@markJobAsComplete');
    Route::get('/{job_id}/unmark-complete', 'JobsController@unMarkJobAsComplete');

});
Route::get('/jobs/listings', 'JobsController@getJobListings');
