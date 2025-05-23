<?php

Route::group(['prefix' => 'reservations'], function () {

	Route::get('/' ,'Dashboard\ReservationController@index')
	->name('reservations.index')
  ->middleware(['permission:show_reservations']);

	Route::get('datatable'	,'Dashboard\ReservationController@dataTable')
	->name('reservations.dataTable')
	->middleware(['permission:show_reservations']);

	Route::get('create'		,'Dashboard\ReservationController@create')
	->name('reservations.create')
	->middleware(['permission:add_reservations']);

	Route::post('/'			,'Dashboard\ReservationController@store')
	->name('reservations.store')
	->middleware(['permission:add_reservations']);

	Route::get('{id}/edit'	,'Dashboard\ReservationController@edit')
	->name('reservations.edit')
  ->middleware(['permission:edit_reservations']);

	Route::put('{id}'		,'Dashboard\ReservationController@update')
	->name('reservations.update')
  ->middleware(['permission:edit_reservations']);

	Route::delete('{id}'	,'Dashboard\ReservationController@destroy')
	->name('reservations.destroy')
  ->middleware(['permission:delete_reservations']);

	Route::get('deletes'	,'Dashboard\ReservationController@deletes')
	->name('reservations.deletes')
  ->middleware(['permission:delete_reservations']);

	Route::get('{id}','Dashboard\ReservationController@show')
	->name('reservations.show')
  ->middleware(['permission:show_reservations']);

  Route::get('available-times/{doctor}/{date}', 'Dashboard\ReservationController@getAvailableTimes')->name('reservations.available-times');
});
