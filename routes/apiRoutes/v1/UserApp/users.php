<?php

Route::group(['prefix' => 'users', 'middleware' => ['auth:api']], function () {
	Route::post('/ratings', 'Api\V1\UserApp\UserController@updateOrCreateRating');
	Route::post('update', 'Api\V1\UserApp\UserProfileController@update');
});

Route::group(['prefix' => 'user', 'middleware' => ['auth:api']], function () {
	Route::delete('delete-account', 'Api\V1\UserApp\UserController@deleteUserAccount');
});
