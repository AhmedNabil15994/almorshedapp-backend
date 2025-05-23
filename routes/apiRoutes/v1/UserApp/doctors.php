<?php

Route::group(['prefix' => 'doctors'], function () {

    Route::post('signup', 'Api\V1\UserApp\DoctorController@signup');

    Route::get('get-doctor-data/{id}', 'Api\V1\UserApp\DoctorController@show')->name('get_doctor_by_id');

    Route::group(['middleware' => ['auth:api']], function () {

        Route::get('profile', 'Api\V1\UserApp\DoctorController@doctor');
        Route::put('update', 'Api\V1\UserApp\DoctorController@update');
        Route::get('/{id}', 'Api\V1\UserApp\DoctorController@show');

        Route::post('availability-exceptions', 'Api\V1\UserApp\DoctorController@addExceptionDate');
        Route::put('availability-exceptions/{id}', 'Api\V1\UserApp\DoctorController@updateExceptionDate');
        Route::delete('availability-exceptions/{id}', 'Api\V1\UserApp\DoctorController@deleteExceptionDate');
    });

});
