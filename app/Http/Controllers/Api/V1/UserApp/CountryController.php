<?php

namespace App\Http\Controllers\Api\V1\UserApp;

use App\Http\Controllers\Api\ApiController;
use Illuminate\Http\Request;
use PragmaRX\Countries\Package\Countries;

class CountryController extends ApiController
{
    /**
     ** Get List Of Countries Based On Our Supported Languages **
     **/
    public function index()
    {
        try {
            $countries = new Countries();
            $supportedCountries = config('setting.supported_countries');
            $requiredCountries = [];
            $transName = 'name_en';
//            $transName = 'name_' . trim(locale());

            foreach ($supportedCountries as $k => $val) {
                $requiredCountries[$k]['code'] = $val;
                $requiredCountries[$k]['name'] = $countries->where('cca2', $val)->first()->{$transName};
                $requiredCountries[$k]['flag'] = $countries->where('cca2', $val)->first()->flag->emoji;
                $requiredCountries[$k]['calling_code'] = $countries->where('cca2', $val)->first()->dialling->calling_code[0];
            }
            return $this->sendResponse($requiredCountries);
        } catch (\Exception $e) {
            return $this->sendError(__('api.general.error_happended'), [], 404);
        }
    }

}
