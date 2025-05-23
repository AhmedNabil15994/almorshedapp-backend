<?php

Route::group(['prefix' => 'roles'], function () {

    Route::get('/', 'Dashboard\RoleController@index')
        ->name('roles.index')
        ->middleware(['permission:show_roles']);

    Route::get('datatable', 'Dashboard\RoleController@dataTable')
        ->name('roles.dataTable')
        ->middleware(['permission:show_roles']);

    Route::get('create', 'Dashboard\RoleController@create')
        ->name('roles.create')
        ->middleware(['permission:add_roles']);

    Route::post('/', 'Dashboard\RoleController@store')
        ->name('roles.store')
        ->middleware(['permission:add_roles']);

    Route::get('{id}/edit', 'Dashboard\RoleController@edit')
        ->name('roles.edit')
        ->middleware(['permission:edit_roles']);

    Route::put('{id}', 'Dashboard\RoleController@update')
        ->name('roles.update')
        ->middleware(['permission:edit_roles']);

    Route::delete('{id}', 'Dashboard\RoleController@destroy')
        ->name('roles.destroy')
        ->middleware(['permission:delete_roles']);

    Route::get('deletes', 'Dashboard\RoleController@deletes')
        ->name('roles.deletes')
        ->middleware(['permission:delete_roles']);

    Route::get('{id}', 'Dashboard\RoleController@show')
        ->name('roles.show')
        ->middleware(['permission:show_roles']);
});
