<?php

Route::group(['prefix' => 'availability-exceptions'], function () {

	Route::get('/' ,'Dashboard\AvailabilityExceptionController@index')
	->name('availability-exceptions.index')
  ->middleware(['permission:show_doctors']);

	Route::get('datatable'	,'Dashboard\AvailabilityExceptionController@dataTable')
	->name('availability-exceptions.dataTable')
	->middleware(['permission:show_doctors']);

	Route::get('create/{doctor_id}'		,'Dashboard\AvailabilityExceptionController@create')
	->name('availability-exceptions.create')
  ->middleware(['permission:add_doctors']);

	Route::post('/'			,'Dashboard\AvailabilityExceptionController@store')
	->name('availability-exceptions.store')
  ->middleware(['permission:add_doctors']);

	Route::get('{id}/edit'	,'Dashboard\AvailabilityExceptionController@edit')
	->name('availability-exceptions.edit')
  ->middleware(['permission:edit_doctors']);

	Route::put('{id}'		,'Dashboard\AvailabilityExceptionController@update')
	->name('availability-exceptions.update')
  ->middleware(['permission:edit_doctors']);

	Route::delete('{id}'	,'Dashboard\AvailabilityExceptionController@destroy')
	->name('availability-exceptions.destroy')
  ->middleware(['permission:delete_doctors']);

	Route::get('deletes'	,'Dashboard\AvailabilityExceptionController@deletes')
	->name('availability-exceptions.deletes')
  ->middleware(['permission:delete_doctors']);

	Route::get('{id}','Dashboard\AvailabilityExceptionController@show')
	->name('availability-exceptions.show')
  ->middleware(['permission:show_doctors']);
});
