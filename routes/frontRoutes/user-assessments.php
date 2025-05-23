<?php

Route::group(['prefix' => 'user-assessments', 'middleware' => ['auth', 'prevent-back-history']], function () {
	Route::post('/', 'Api\V1\UserApp\UserAssessmentController@store')->name('user-assessments');
});