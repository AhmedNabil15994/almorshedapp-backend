<?php

Route::group(['prefix' => 'users'], function () {

	Route::get('/' ,'Dashboard\UserController@index')
	->name('users.index')
  ->middleware(['permission:show_users']);

	Route::get('datatable'	,'Dashboard\UserController@dataTable')
	->name('users.dataTable')
	->middleware(['permission:show_users']);

	Route::get('create'		,'Dashboard\UserController@create')
	->name('users.create')
  ->middleware(['permission:add_users']);

	Route::post('/'			,'Dashboard\UserController@store')
	->name('users.store')
  ->middleware(['permission:add_users']);

	Route::get('{id}/edit'	,'Dashboard\UserController@edit')
	->name('users.edit')
  ->middleware(['permission:edit_users']);

	Route::put('{id}'		,'Dashboard\UserController@update')
	->name('users.update')
  ->middleware(['permission:edit_users']);

	Route::delete('{id}'	,'Dashboard\UserController@destroy')
	->name('users.destroy')
  ->middleware(['permission:delete_users']);

	Route::get('deletes'	,'Dashboard\UserController@deletes')
	->name('users.deletes')
  ->middleware(['permission:delete_users']);

	Route::get('{id}','Dashboard\UserController@show')
	->name('users.show')
  ->middleware(['permission:show_users']);
});
