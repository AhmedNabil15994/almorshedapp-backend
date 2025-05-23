<?php

namespace App\Modules\Doctors\Resources;

use App\Modules\Categories\Resources\CategoryResource;
use App\Modules\Languages\Resources\LanguageResource;
use App\Modules\Availabilities\Resources\AvailabilityResource;
use App\Modules\AvailabilityExceptions\Resources\AvailabilityExceptionResource;
use App\Modules\Users\Resources\UserResource;
use App\Modules\Reservations\Resources\ReservationResource;
use Illuminate\Http\Resources\Json\Resource;

class DoctorResource extends Resource
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
            'id'                        => $this->id,
            'user_id'                   => $this->user->id,
            'name'                      => $this->user->name,
            'email'                     => $this->user->email,
            'calling_code'              => $this->user->calling_code,
            'mobile'                    => $this->user->mobile,
            'status'                    => $this->user->status,
            'avatar'                    => url($this->user->avatar),
            'academic_degree'           => $this->academic_degree,
            'current_workplaces'        => $this->current_workplaces,
            'previous_experience'       => $this->previous_experience,
            'iban'                      => $this->iban,
            'account_name'              => $this->account_name,
            'bank_name'                 => $this->bank_name,
            'card_name'                 => $this->card_name,
            'specialization'            => $this->specialization,
            'rate'                      => ceil($this->user->averageRating),
            'categories'                => CategoryResource::collection($this->categories),
            'languages'                 => LanguageResource::collection($this->languages),
            'created_at'                => date('d-m-Y' , strtotime($this->created_at)),

            'vailability'               => AvailabilityResource::collection($this->vailability),
            'availability_exceptions'   => AvailabilityExceptionResource::collection($this->availabilityException),
            'services'                  => ServiceResource::collection($this->activeServices()),
            'reservations'              => ReservationResource::collection($this->reservations),
        ];
    }
}
