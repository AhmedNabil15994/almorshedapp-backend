<?php

Route::group(['prefix' => 'addresses'], function () {


		Route::get('countries' 						, 'Api\V1\UserApp\AddressUserController@countries');
		Route::get('cities/{code}' 				, 'Api\V1\UserApp\AddressUserController@cities');

		Route::group(['middleware' => ['auth:api'] ], function () {

			Route::get('/' 							, 'Api\V1\UserApp\AddressUserController@addresses');
			Route::post('/' 						, 'Api\V1\UserApp\AddressUserController@addAddress');
			Route::delete('{id}' 				, 'Api\V1\UserApp\AddressUserController@deleteAddress');

		});

});
