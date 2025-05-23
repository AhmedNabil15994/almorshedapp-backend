<?php

Route::group(['prefix' => 'auth'], function () {

		Route::post('login' 						, 'Api\V1\UserApp\AuthUserController@login');
		Route::post('signup' 						, 'Api\V1\UserApp\AuthUserController@signup');
		Route::post('forget-password' 	, 'Api\V1\UserApp\AuthUserController@forgetPassword');

		Route::group(['middleware' => ['auth:api'] ], function () {

				Route::get('profile'  , 'Api\V1\UserApp\AuthUserController@user');
				Route::post('logout'  , 'Api\V1\UserApp\AuthUserController@logout');
				Route::put('update' 	, 'Api\V1\UserApp\AuthUserController@update');
				Route::post('reset-password', 'Api\V1\UserApp\AuthUserController@resetPassword');
		});

});
