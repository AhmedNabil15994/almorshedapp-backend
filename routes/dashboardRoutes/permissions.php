<?php

Route::group(['prefix' => 'permissions'], function () {

    Route::get('/', 'Dashboard\PermissionController@index')
        ->name('permissions.index')
        ->middleware(['permission:show_roles']);

    Route::get('datatable', 'Dashboard\PermissionController@dataTable')
        ->name('permissions.dataTable')
        ->middleware(['permission:show_roles']);

    Route::get('create', 'Dashboard\PermissionController@create')
        ->name('permissions.create')
        ->middleware(['permission:add_roles']);

    Route::post('/', 'Dashboard\PermissionController@store')
        ->name('permissions.store')
        ->middleware(['permission:add_roles']);

    Route::get('{id}/edit', 'Dashboard\PermissionController@edit')
        ->name('permissions.edit')
        ->middleware(['permission:edit_roles']);

    Route::put('{id}', 'Dashboard\PermissionController@update')
        ->name('permissions.update')
        ->middleware(['permission:edit_roles']);

    Route::delete('{id}', 'Dashboard\PermissionController@destroy')
        ->name('permissions.destroy')
        ->middleware(['permission:delete_roles']);

    Route::get('deletes', 'Dashboard\PermissionController@deletes')
        ->name('permissions.deletes')
        ->middleware(['permission:delete_roles']);

    Route::get('{id}', 'Dashboard\PermissionController@show')
        ->name('permissions.show')
        ->middleware(['permission:show_roles']);

});
