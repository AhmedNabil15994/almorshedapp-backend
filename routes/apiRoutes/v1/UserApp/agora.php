<?php

Route::group(['prefix' => 'agora', 'middleware' => ['api']], function () {
	Route::post('/token' , 'Api\V1\UserApp\AgoraController@index');
});