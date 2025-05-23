<?php

Route::group(['prefix' => 'assessments'], function () {

    Route::get('/', 'Dashboard\AssessmentController@index')
        ->name('assessments.index')
        ->middleware(['permission:show_assessments']);

    Route::get('datatable', 'Dashboard\AssessmentController@dataTable')
        ->name('assessments.dataTable')
        ->middleware(['permission:show_assessments']);

    Route::get('create', 'Dashboard\AssessmentController@create')
        ->name('assessments.create')
        ->middleware(['permission:add_assessments']);

    Route::post('/', 'Dashboard\AssessmentController@store')
        ->name('assessments.store')
        ->middleware(['permission:add_assessments']);

    Route::get('{id}/edit', 'Dashboard\AssessmentController@edit')
        ->name('assessments.edit')
        ->middleware(['permission:edit_assessments']);

    Route::put('{id}', 'Dashboard\AssessmentController@update')
        ->name('assessments.update')
        ->middleware(['permission:edit_assessments']);

    Route::delete('{id}', 'Dashboard\AssessmentController@destroy')
        ->name('assessments.destroy')
        ->middleware(['permission:delete_assessments']);

    Route::get('deletes', 'Dashboard\AssessmentController@deletes')
        ->name('assessments.deletes')
        ->middleware(['permission:delete_assessments']);

    Route::get('{id}', 'Dashboard\AssessmentController@show')
        ->name('assessments.show')
        ->middleware(['permission:show_assessments']);
});
