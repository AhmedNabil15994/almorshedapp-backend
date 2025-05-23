<?php

Route::group(['prefix' => 'notification'], function () {

    Route::get('/', 'Dashboard\NotificationController@notifyForm')
        ->name('notification.index')
        ->middleware(['permission:show_notifications']);

    Route::get('datatable', 'Dashboard\NotificationController@dataTable')
        ->name('notification.dataTable');

    Route::get('create', 'Dashboard\NotificationController@create')
        ->name('notification.create');

    Route::post('/', 'Dashboard\NotificationController@push_notification')
        ->name('notification.store')
        ->middleware(['permission:show_notifications']);

    Route::get('{id}/edit', 'Dashboard\NotificationController@edit')
        ->name('notification.edit');

    Route::put('{id}', 'Dashboard\NotificationController@update')
        ->name('notification.update');

    Route::delete('{id}', 'Dashboard\NotificationController@destroy')
        ->name('notification.destroy');

    Route::get('deletes', 'Dashboard\NotificationController@deletes')
        ->name('notification.deletes');

    Route::get('{id}', 'Dashboard\NotificationController@show')
        ->name('notification.show');
});
