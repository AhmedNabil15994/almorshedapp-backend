<?php

Route::group(['prefix' => '/'], function () {

	Route::get('/'  , 'Front\HomeController@index')->name('home');

});
