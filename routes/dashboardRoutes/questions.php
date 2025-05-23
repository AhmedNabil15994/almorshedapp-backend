<?php

Route::group(['prefix' => 'questions'], function () {

	Route::get('/' ,'Dashboard\QuestionController@index')
	->name('questions.index')
  ->middleware(['permission:show_questions']);

	Route::get('datatable'	,'Dashboard\QuestionController@dataTable')
	->name('questions.dataTable')
	->middleware(['permission:show_questions']);

	Route::get('create/{assessment_id}'		,'Dashboard\QuestionController@create')
	->name('questions.create')
  ->middleware(['permission:add_questions']);

	Route::post('/'			,'Dashboard\QuestionController@store')
	->name('questions.store')
  ->middleware(['permission:add_questions']);

	Route::get('{id}/edit'	,'Dashboard\QuestionController@edit')
	->name('questions.edit')
  ->middleware(['permission:edit_questions']);

	Route::put('{id}'		,'Dashboard\QuestionController@update')
	->name('questions.update')
  ->middleware(['permission:edit_questions']);

	Route::delete('{id}'	,'Dashboard\QuestionController@destroy')
	->name('questions.destroy')
  ->middleware(['permission:delete_questions']);

	Route::get('deletes'	,'Dashboard\QuestionController@deletes')
	->name('questions.deletes')
  ->middleware(['permission:delete_questions']);

	Route::get('{id}','Dashboard\QuestionController@show')
	->name('questions.show')
  ->middleware(['permission:show_questions']);
});
