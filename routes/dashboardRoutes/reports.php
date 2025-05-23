<?php

Route::group(['prefix' => 'reports'], function () {

    Route::get('/', 'Dashboard\ReportController@index')
        ->name('reports.index')
        ->middleware(['permission:show_reports']);
});
