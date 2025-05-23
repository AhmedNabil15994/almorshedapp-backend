<?php

namespace App\Modules\OrderStatuses\Resources;

use Illuminate\Http\Resources\Json\Resource;

class OrderStatusResource extends Resource
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
            'title'                => $this->title,
            'code'                 => $this->code,
        ];
    }
}
