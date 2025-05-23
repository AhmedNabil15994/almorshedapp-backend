<?php

Route::group(['prefix' => 'contact', 'middleware' => ['api']], function () {
	Route::post('/' 			, 'Api\V1\UserApp\ContactController@send');
});