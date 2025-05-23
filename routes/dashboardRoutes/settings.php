<?php

Route::group(['prefix' => 'settings'], function () {

	Route::get('/' 	,'Dashboard\SettingController@index')
	->name('settings.index');

	Route::post('/'	,'Dashboard\SettingController@store')
	->name('settings.store');

});
