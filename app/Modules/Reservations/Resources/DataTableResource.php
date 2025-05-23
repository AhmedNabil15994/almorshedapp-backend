<?php

namespace App\Modules\Reservations\Resources;

use Carbon\Carbon;
use Illuminate\Http\Resources\Json\Resource;

class DataTableResource extends Resource
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
            'id'               => $this->id,
        ];
    }
}
