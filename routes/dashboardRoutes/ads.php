<?php

Route::group(['prefix' => 'ads'], function () {

	Route::get('/' ,'Dashboard\AdController@index')
	->name('ads.index')
  ->middleware(['permission:show_ads']);

	Route::get('datatable'	,'Dashboard\AdController@dataTable')
	->name('ads.dataTable')
	->middleware(['permission:show_ads']);

	Route::get('create'		,'Dashboard\AdController@create')
	->name('ads.create')
  ->middleware(['permission:add_ads']);

	Route::post('/'			,'Dashboard\AdController@store')
	->name('ads.store')
  ->middleware(['permission:add_ads']);

	Route::get('{id}/edit'	,'Dashboard\AdController@edit')
	->name('ads.edit')
  ->middleware(['permission:edit_ads']);

	Route::put('{id}'		,'Dashboard\AdController@update')
	->name('ads.update')
  ->middleware(['permission:edit_ads']);

	Route::delete('{id}'	,'Dashboard\AdController@destroy')
	->name('ads.destroy')
  ->middleware(['permission:delete_ads']);

	Route::get('deletes'	,'Dashboard\AdController@deletes')
	->name('ads.deletes')
  ->middleware(['permission:delete_ads']);

	Route::get('{id}','Dashboard\AdController@show')
	->name('ads.show')
  ->middleware(['permission:show_ads']);
});
