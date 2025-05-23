<?php

namespace App\Modules\AvailabilityExceptions\Resources;

use Illuminate\Http\Resources\Json\Resource;

class AvailabilityExceptionResource extends Resource
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
            'id'             => $this->id,
            'off_from'       => $this->off_from,
            'off_to'         => $this->off_to,
            'off_date'       => $this->off_date
        ];
    }
}
