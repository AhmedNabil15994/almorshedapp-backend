<?php

Route::group(['prefix' => 'assessments', 'middleware' => ['api']], function () {
	Route::get('/', 'Api\V1\UserApp\AssessmentController@index');
	Route::post('/', 'Api\V1\UserApp\AssessmentController@store');
	Route::get('{id}', 'Api\V1\UserApp\AssessmentController@show');
});