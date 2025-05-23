<?php

Route::group(['prefix' => 'languages'], function () {
	Route::get('/', 'Api\V1\UserApp\LanguageController@index');
});
