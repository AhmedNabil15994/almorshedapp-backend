<?php

Route::group(['prefix' => 'reservations', 'middleware' => ['auth', 'prevent-back-history']], function () {
	Route::get('/', 'Api\V1\UserApp\ReservationController@index');
	Route::post('/', 'Api\V1\UserApp\ReservationController@store')->name('reservations');
});