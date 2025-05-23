<?php

namespace App\Modules\Ads\Resources;

use Illuminate\Http\Resources\Json\Resource;

class AdResource extends Resource
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
            'name'                 => $this->name,
            'link'                 => $this->link,
            'image'                => url($this->image),
        ];
    }
}
