<?php

Route::group(['prefix' => 'reservations'], function () {
	Route::get('success-payment' ,'Api\V1\UserApp\ReservationController@successPayment')
		->name('api.checkout.payment-success');

	Route::get('failed-payment' ,'Api\V1\UserApp\ReservationController@failedPayment')
		->name('api.checkout.payment-failed');

	Route::post('upayments-webhook' ,'Api\V1\UserApp\ReservationController@uPaymentsWebhook')
		->name('api.checkout.upayments-webhook');

	Route::group(['middleware' => ['auth:api'] ], function () {
		Route::post('execute-payment', 'Api\V1\UserApp\ReservationController@executePayment');
		Route::post('/', 'Api\V1\UserApp\ReservationController@store');
		Route::put('{id}', 'Api\V1\UserApp\ReservationController@update');
		Route::get('{id}', 'Api\V1\UserApp\ReservationController@show');
	});
});

Route::group(['middleware' => ['auth:api'] ], function () {
	Route::get('user-reservations', 'Api\V1\UserApp\ReservationController@getUserReservations');
	Route::get('doctor-reservations', 'Api\V1\UserApp\ReservationController@getDoctorReservations');
});
