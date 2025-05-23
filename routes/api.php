<?php

Route::prefix('v1')->middleware(['Apilocalization','api'])->group(function () {

  /*
  |--------------------------------------------------------------------------
  |                     API Routes For User Application
  |--------------------------------------------------------------------------
  */
  Route::prefix('/')->middleware(['Apilocalization','api'])->group(function () {

      Route::get('countries', 'Api\V1\UserApp\CountryController@index');

      foreach (File::allFiles(base_path('routes/apiRoutes/v1/UserApp')) as $file) {
          require_once($file->getPathname());
      }

  });

});
