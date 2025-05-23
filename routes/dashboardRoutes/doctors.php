<?php

Route::group(['prefix' => 'doctors'], function () {

    Route::get('/', 'Dashboard\DoctorController@index')
        ->name('doctors.index')
        ->middleware(['permission:show_doctors']);

    Route::get('datatable', 'Dashboard\DoctorController@dataTable')
        ->name('doctors.dataTable')
        ->middleware(['permission:show_doctors']);

    Route::get('create', 'Dashboard\DoctorController@create')
        ->name('doctors.create')
        ->middleware(['permission:add_doctors']);

    Route::post('/', 'Dashboard\DoctorController@store')
        ->name('doctors.store')
        ->middleware(['permission:add_doctors']);

    Route::get('{id}/edit', 'Dashboard\DoctorController@edit')
        ->name('doctors.edit')
        ->middleware(['permission:edit_doctors']);

    Route::put('{id}', 'Dashboard\DoctorController@update')
        ->name('doctors.update')
        ->middleware(['permission:edit_doctors']);

    Route::delete('{id}', 'Dashboard\DoctorController@destroy')
        ->name('doctors.destroy')
        ->middleware(['permission:delete_doctors']);

    Route::get('deletes', 'Dashboard\DoctorController@deletes')
        ->name('doctors.deletes')
        ->middleware(['permission:delete_doctors']);

    Route::get('{id}', 'Dashboard\DoctorController@show')
        ->name('doctors.show')
        ->middleware(['permission:show_doctors']);

    Route::get('{id}/availability_exceptions', 'Dashboard\DoctorController@showAvailabilityExceptions')
        ->name('doctors.show-availability-exceptions')
        ->middleware(['permission:show_doctors']);
});
