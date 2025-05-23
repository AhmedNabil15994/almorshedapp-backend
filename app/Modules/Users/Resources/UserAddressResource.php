<?php

namespace App\Modules\Users\Resources;

use Illuminate\Http\Resources\Json\Resource;

class UserAddressResource extends Resource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array
     */
    public function toArray($request)
    {
         return [
            'id'              => $this->id,
						'country'         => $this->country,
            'city'            => $this->city,
            'state'           => $this->state,
            'address'         => $this->address,
            'address_2'       => $this->address_2,
            'additional_info' => $this->additional_info,
            'zip'             => $this->zip,
            'username'        => $this->username,
            'email'           => $this->email,
            'mobile'          => $this->mobile,
        ];
    }
}
