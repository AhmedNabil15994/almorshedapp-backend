<?php

namespace App\Http\Controllers\Api\V1\UserApp;

use App\Http\Controllers\Api\ApiController;
use Illuminate\Http\Request;

class SettingController extends ApiController
{

    public function getSettings()
    {
        return config('setting');
    }
}
