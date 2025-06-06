<?php

namespace App\Modules\Days\Resources;

use Illuminate\Http\Resources\Json\Resource;

class DayResource extends Resource
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
            'day'                  => $this->day,
        ];
    }
}
