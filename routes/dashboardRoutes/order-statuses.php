<?php

Route::group(['prefix' => 'order-statuses'], function () {

	Route::get('/' ,'Dashboard\OrderStatusController@index')
	->name('order-statuses.index')
  ->middleware(['permission:show_orders']);

	Route::get('datatable'	,'Dashboard\OrderStatusController@dataTable')
	->name('order-statuses.dataTable')
	->middleware(['permission:show_orders']);

	Route::get('create'		,'Dashboard\OrderStatusController@create')
	->name('order-statuses.create')
  ->middleware(['permission:add_orders']);

	Route::post('/'			,'Dashboard\OrderStatusController@store')
	->name('order-statuses.store')
  ->middleware(['permission:add_orders']);

	Route::get('{id}/edit'	,'Dashboard\OrderStatusController@edit')
	->name('order-statuses.edit')
  ->middleware(['permission:edit_orders']);

	Route::put('{id}'		,'Dashboard\OrderStatusController@update')
	->name('order-statuses.update')
  ->middleware(['permission:edit_orders']);

	Route::delete('{id}'	,'Dashboard\OrderStatusController@destroy')
	->name('order-statuses.destroy')
  ->middleware(['permission:delete_orders']);

	Route::get('deletes'	,'Dashboard\OrderStatusController@deletes')
	->name('order-statuses.deletes')
  ->middleware(['permission:delete_orders']);

	Route::get('{id}','Dashboard\OrderStatusController@show')
	->name('order-statuses.show')
  ->middleware(['permission:show_orders']);
});
