<?php

Route::group(['prefix' => 'answers'], function () {

	Route::get('/' ,'Dashboard\AnswerController@index')
	->name('answers.index')
  ->middleware(['permission:show_questions']);

	Route::get('datatable'	,'Dashboard\AnswerController@dataTable')
	->name('answers.dataTable')
	->middleware(['permission:show_questions']);

	Route::get('create/{question_id}'		,'Dashboard\AnswerController@create')
	->name('answers.create')
  ->middleware(['permission:add_questions']);

	Route::post('/'			,'Dashboard\AnswerController@store')
	->name('answers.store')
  ->middleware(['permission:add_questions']);

	Route::get('{id}/edit'	,'Dashboard\AnswerController@edit')
	->name('answers.edit')
  ->middleware(['permission:edit_questions']);

	Route::put('{id}'		,'Dashboard\AnswerController@update')
	->name('answers.update')
  ->middleware(['permission:edit_questions']);

	Route::delete('{id}'	,'Dashboard\AnswerController@destroy')
	->name('answers.destroy')
  ->middleware(['permission:delete_questions']);

	Route::get('deletes'	,'Dashboard\AnswerController@deletes')
	->name('answers.deletes')
  ->middleware(['permission:delete_questions']);

	Route::get('{id}','Dashboard\AnswerController@show')
	->name('answers.show')
  ->middleware(['permission:show_questions']);
});
