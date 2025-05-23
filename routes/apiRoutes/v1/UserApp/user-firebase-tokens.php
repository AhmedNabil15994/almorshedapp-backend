<?php

Route::group(['prefix' => 'user-firebase-tokens'/*, 'middleware' => ['auth:api']*/], function () {
	Route::post('/', 'Api\V1\UserApp\UserFirebaseTokenController@store');
});
