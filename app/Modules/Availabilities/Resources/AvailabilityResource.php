<?php

namespace App\Modules\Availabilities\Resources;

//use App\Modules\Days\Resources\DayResource;
use Illuminate\Http\Resources\Json\Resource;

class AvailabilityResource extends Resource
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
            'id'                   => $this->id,
            'available_from'       => $this->available_from,
            'available_to'         => $this->available_to,
            'day_id'               => $this->day_id,
            'day'                  => $this->day->day,
        ];
    }
}
