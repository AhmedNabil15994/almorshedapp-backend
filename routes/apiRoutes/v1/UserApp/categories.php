<?php

Route::group(['prefix' => 'categories', 'middleware' => ['api']], function () {

		Route::get('/', 'Api\V1\UserApp\CategoryController@categories');
		
		Route::get('/doctors', 'Api\V1\UserApp\CategoryController@doctors');

		Route::get('{id}', 'Api\V1\UserApp\CategoryController@category');
});
