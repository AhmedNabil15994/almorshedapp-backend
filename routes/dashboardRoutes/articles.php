<?php

Route::group(['prefix' => 'articles'], function () {

    Route::get('/', 'Dashboard\ArticleController@index')
        ->name('articles.index')
        ->middleware(['permission:show_articles']);

    Route::get('datatable', 'Dashboard\ArticleController@dataTable')
        ->name('articles.dataTable')
        ->middleware(['permission:show_articles']);

    Route::get('create', 'Dashboard\ArticleController@create')
        ->name('articles.create')
        ->middleware(['permission:add_articles']);

    Route::post('/', 'Dashboard\ArticleController@store')
        ->name('articles.store')
        ->middleware(['permission:add_articles']);

    Route::get('{id}/edit', 'Dashboard\ArticleController@edit')
        ->name('articles.edit')
        ->middleware(['permission:edit_articles']);

    Route::put('{id}', 'Dashboard\ArticleController@update')
        ->name('articles.update')
        ->middleware(['permission:edit_articles']);

    Route::delete('{id}', 'Dashboard\ArticleController@destroy')
        ->name('articles.destroy')
        ->middleware(['permission:delete_articles']);

    Route::get('deletes', 'Dashboard\ArticleController@deletes')
        ->name('articles.deletes')
        ->middleware(['permission:delete_articles']);

    Route::get('{id}', 'Dashboard\ArticleController@show')
        ->name('articles.show')
        ->middleware(['permission:show_articles']);
});
