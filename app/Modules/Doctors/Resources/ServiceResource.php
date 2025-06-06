<?php

namespace App\Modules\Doctors\Resources;

use Illuminate\Http\Resources\Json\Resource;

class ServiceResource extends Resource
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
            'description'   => $this->description,
            'image'         => url($this->image),
            'price'         => $this->pivot->price,
        ];
    }
}
