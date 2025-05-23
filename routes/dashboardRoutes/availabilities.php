<?php

Route::group(['prefix' => 'availabilities'], function () {

	Route::get('/' ,'Dashboard\AvailabilityController@index')
	->name('availabilities.index')
  ->middleware(['permission:show_doctors']);

	Route::get('datatable'	,'Dashboard\AvailabilityController@dataTable')
	->name('availabilities.dataTable')
	->middleware(['permission:show_doctors']);

	Route::get('create/{doctor_id}'		,'Dashboard\AvailabilityController@create')
	->name('availabilities.create')
  ->middleware(['permission:add_doctors']);

	Route::post('/'			,'Dashboard\AvailabilityController@store')
	->name('availabilities.store')
  ->middleware(['permission:add_doctors']);

	Route::get('{id}/edit'	,'Dashboard\AvailabilityController@edit')
	->name('availabilities.edit')
  ->middleware(['permission:edit_doctors']);

	Route::put('{id}'		,'Dashboard\AvailabilityController@update')
	->name('availabilities.update')
  ->middleware(['permission:edit_doctors']);

	Route::delete('{id}'	,'Dashboard\AvailabilityController@destroy')
	->name('availabilities.destroy')
  ->middleware(['permission:delete_doctors']);

	Route::get('deletes'	,'Dashboard\AvailabilityController@deletes')
	->name('availabilities.deletes')
  ->middleware(['permission:delete_doctors']);

	Route::get('{id}','Dashboard\AvailabilityController@show')
	->name('availabilities.show')
  ->middleware(['permission:show_doctors']);
});
