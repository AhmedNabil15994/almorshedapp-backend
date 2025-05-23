<?php

Route::group(['prefix' => 'categories'], function () {

	Route::get('/' ,'Dashboard\CategoryController@index')
	->name('categories.index')
  ->middleware(['permission:show_categories']);

	Route::get('datatable'	,'Dashboard\CategoryController@dataTable')
	->name('categories.dataTable')
	->middleware(['permission:show_categories']);

	Route::get('create'		,'Dashboard\CategoryController@create')
	->name('categories.create')
  ->middleware(['permission:add_categories']);

	Route::post('/'			,'Dashboard\CategoryController@store')
	->name('categories.store')
  ->middleware(['permission:add_categories']);

	Route::get('{id}/edit'	,'Dashboard\CategoryController@edit')
	->name('categories.edit')
  ->middleware(['permission:edit_categories']);

	Route::put('{id}'		,'Dashboard\CategoryController@update')
	->name('categories.update')
  ->middleware(['permission:edit_categories']);

	Route::delete('{id}'	,'Dashboard\CategoryController@destroy')
	->name('categories.destroy')
  ->middleware(['permission:delete_categories']);

	Route::get('deletes'	,'Dashboard\CategoryController@deletes')
	->name('categories.deletes')
  ->middleware(['permission:delete_categories']);

	Route::get('{id}','Dashboard\CategoryController@show')
	->name('categories.show')
  ->middleware(['permission:show_categories']);
});
