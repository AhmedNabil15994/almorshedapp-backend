<?php

namespace App\Http\Controllers\Api\V1\UserApp;

use App\Modules\Users\Repository\UserRepository as User;
use App\Modules\Users\Resources\UserAddressResource;
use PragmaRX\Countries\Package\Countries;
use App\Http\Controllers\Api\ApiController;
use Illuminate\Http\Request;

class AddressUserController extends ApiController
{
    /**
     * Create a new controller instance.
     */
    public function __construct(User $user)
    {
        $this->user   = $user;
    }

    public function countries(Request $request)
    {
        $countries = Countries::all();

        $supported = [];

        foreach ($countries as $key => $value) {

            if ((collect(config('setting.supported_countries'))->contains($value->cca2))){
                $country['name']          = $value->name->common;
                $country['code']          = $value->cca2;
                $country['flag']          = $value->flag->emoji;
                $country['calling_code']  = $value->dialling->calling_code;

                $supported[] = $country;
            }
        }

        return $this->sendResponse($supported);
    }

    public function cities($code)
    {
        $cities = Countries::where('cca2', $code)->first()
                  ->hydrateStates()->states->sortBy('name')
                  ->pluck('name', 'postal')->toArray();

         $citiesOfCountry = [];

         foreach ($cities as $key => $value) {

                 $city['name']  = $value;
                 $city['code']  = $key;

                 $citiesOfCountry[] = $city;
         }

         return $this->sendResponse($citiesOfCountry);
    }

    public function addAddress(Request $request)
    {
        $address = $this->user->createAddress($request);

        if (!$address) {
            return $this->sendError('something error', [], 404);
        }

        return $this->sendResponse(new UserAddressResource($address));
    }

    public function addresses(Request $request)
    {
        $address = $this->user->userAddresses();

        if (!$address) {
            return $this->sendError('something error', [], 404);
        }

        return $this->sendResponse(UserAddressResource::collection($address));
    }

    public function deleteAddress($id)
    {
        $address = $this->user->deleteAddress($id);

        if (!$address) {
            return $this->sendError('something error', [], 404);
        }

        return $this->sendResponse('Delete Succesfully');
    }

}
