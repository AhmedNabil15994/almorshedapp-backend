<?php

Route::group(['prefix' => 'services'], function () {

	Route::get('/' ,'Dashboard\ServiceController@index')
	->name('services.index')
  ->middleware(['permission:show_services']);

	Route::get('datatable'	,'Dashboard\ServiceController@dataTable')
	->name('services.dataTable')
	->middleware(['permission:show_services']);

	Route::get('create'		,'Dashboard\ServiceController@create')
	->name('services.create')
  ->middleware(['permission:add_services']);

	Route::post('/'			,'Dashboard\ServiceController@store')
	->name('services.store')
  ->middleware(['permission:add_services']);

	Route::get('{id}/edit'	,'Dashboard\ServiceController@edit')
	->name('services.edit')
  ->middleware(['permission:edit_services']);

	Route::put('{id}'		,'Dashboard\ServiceController@update')
	->name('services.update')
  ->middleware(['permission:edit_services']);

	Route::delete('{id}'	,'Dashboard\ServiceController@destroy')
	->name('services.destroy')
  ->middleware(['permission:delete_services']);

	Route::get('deletes'	,'Dashboard\ServiceController@deletes')
	->name('services.deletes')
  ->middleware(['permission:delete_services']);

	Route::get('{id}','Dashboard\ServiceController@show')
	->name('services.show')
  ->middleware(['permission:show_services']);
});
