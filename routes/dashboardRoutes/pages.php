<?php

Route::group(['prefix' => 'pages'], function () {

	Route::get('/' ,'Dashboard\PageController@index')
	->name('pages.index')
  ->middleware(['permission:show_pages']);

	Route::get('datatable'	,'Dashboard\PageController@dataTable')
	->name('pages.dataTable')
	->middleware(['permission:show_pages']);

	Route::get('create'		,'Dashboard\PageController@create')
	->name('pages.create')
  ->middleware(['permission:add_pages']);

	Route::post('/'			,'Dashboard\PageController@store')
	->name('pages.store')
  ->middleware(['permission:add_pages']);

	Route::get('{id}/edit'	,'Dashboard\PageController@edit')
	->name('pages.edit')
  ->middleware(['permission:edit_pages']);

	Route::put('{id}'		,'Dashboard\PageController@update')
	->name('pages.update')
  ->middleware(['permission:edit_pages']);

	Route::delete('{id}'	,'Dashboard\PageController@destroy')
	->name('pages.destroy')
  ->middleware(['permission:delete_pages']);

	Route::get('deletes'	,'Dashboard\PageController@deletes')
	->name('pages.deletes')
  ->middleware(['permission:delete_pages']);

	Route::get('{id}','Dashboard\PageController@show')
	->name('pages.show')
  ->middleware(['permission:show_pages']);
});
