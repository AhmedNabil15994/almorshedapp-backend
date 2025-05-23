<?php

namespace App\Modules\Users\Resources;

use App\Modules\Doctors\Resources\DoctorResource;
use App\Modules\Subscriptions\Resources\SubscriptionResource;
use App\Modules\Roles\Resources\RoleResource;
use App\Modules\Reservations\Resources\ReservationResource;
use Illuminate\Http\Resources\Json\Resource;

class UserResource extends Resource
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
            'id'            => $this->id,
            'name'          => $this->name,
            'email'         => $this->email,
             'iban' => $this->doctor ? $this->doctor->iban  : null,
             'account_name' => $this->doctor ? $this->doctor->account_name :  null,
            'calling_code'  => $this->calling_code,
            'mobile'        => $this->mobile,
            'avatar'        => url($this->avatar),
            'created_at'    => (string) $this->created_at,
            'roles'         => RoleResource::collection($this->roles),
            'type'          => $this->doctor()->exists() ? 'doctor' : 'user',
             'status' => $this->status,
            'reservations'  => ReservationResource::collection($this->reservations)
        ];
    }
}
