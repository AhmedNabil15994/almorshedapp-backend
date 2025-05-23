<?php

Route::group(['prefix' => 'languages'], function () {

	Route::get('/' ,'Dashboard\LanguageController@index')
	->name('languages.index')
  ->middleware(['permission:show_languages']);

	Route::get('datatable'	,'Dashboard\LanguageController@dataTable')
	->name('languages.dataTable')
	->middleware(['permission:show_languages']);

	Route::get('create'		,'Dashboard\LanguageController@create')
	->name('languages.create')
  ->middleware(['permission:add_languages']);

	Route::post('/'			,'Dashboard\LanguageController@store')
	->name('languages.store')
  ->middleware(['permission:add_languages']);

	Route::get('{id}/edit'	,'Dashboard\LanguageController@edit')
	->name('languages.edit')
  ->middleware(['permission:edit_languages']);

	Route::put('{id}'		,'Dashboard\LanguageController@update')
	->name('languages.update')
  ->middleware(['permission:edit_languages']);

	Route::delete('{id}'	,'Dashboard\LanguageController@destroy')
	->name('languages.destroy')
  ->middleware(['permission:delete_languages']);

	Route::get('deletes'	,'Dashboard\LanguageController@deletes')
	->name('languages.deletes')
  ->middleware(['permission:delete_languages']);

	Route::get('{id}','Dashboard\LanguageController@show')
	->name('languages.show')
  ->middleware(['permission:show_languages']);
});
