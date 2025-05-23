<?php

Route::group(['prefix' => 'settings'], function () {

			Route::get('/' 	, 'Api\V1\UserApp\SettingController@getSettings');

});
