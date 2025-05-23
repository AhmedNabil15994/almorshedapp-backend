<?php

Route::group(['prefix' => 'ads', 'middleware' => ['api']], function () {
	Route::get('/', 'Api\V1\UserApp\AdController@ads');
});