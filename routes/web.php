<?php

Route::group(
    ['prefix'			=> LaravelLocalization::setLocale(),
		'middleware' 	=> ['localeSessionRedirect', 'localizationRedirect', 'localeViewPath' ]],
    function () {

        /*
        |================================================================================
        |                         LARAVEL MANAGER FILES & IMAGES
        |================================================================================
        */
        Route::group(['prefix' => 'laravel-filemanager', 'middleware' => ['web', 'auth']], function () {
           \UniSharp\LaravelFilemanager\Lfm::routes();
        });

        /*
        |================================================================================
        |                             DASHBOARD ROUTES
        |================================================================================
        */
        // ,'permission:admin_dashboard'
        Route::prefix('dashboard')->middleware(['auth'])->group(function () {
            foreach (File::allFiles(base_path('routes/dashboardRoutes')) as $file) {
                require_once($file->getPathname());
            }
        });


        /*
        |================================================================================
        |                             AUTH ROUTES
        |================================================================================
        */
        Route::prefix('/')->group(function () {
            foreach (File::allFiles(base_path('routes/authRoutes')) as $file) {
                require_once($file->getPathname());
            }
        });

        /*
        |================================================================================
        |                             FRONT-END ROUTES
        |================================================================================
        */
        Route::prefix('/')->group(function () {
            foreach (File::allFiles(base_path('routes/frontRoutes')) as $file) {
                require_once($file->getPathname());
            }
        });
    }
);
