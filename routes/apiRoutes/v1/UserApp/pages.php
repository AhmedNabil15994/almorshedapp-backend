<?php

Route::group(['prefix' => 'pages', 'middleware' => ['api']], function () {

		Route::get('/' 			, 'Api\V1\UserApp\PageController@pages');
		Route::get('{id}' 	, 'Api\V1\UserApp\PageController@page');

});
