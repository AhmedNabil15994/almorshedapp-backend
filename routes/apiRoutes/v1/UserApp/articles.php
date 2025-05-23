<?php

Route::group(['prefix' => 'articles', 'middleware' => ['api']], function () {

		Route::get('/' 			, 'Api\V1\UserApp\ArticleController@articles');
		Route::get('{id}' 	, 'Api\V1\UserApp\ArticleController@article');

});