<?php

namespace App\Modules\Categories\Resources;

use Illuminate\Http\Resources\Json\Resource;

class CategoryResource extends Resource
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
            'image'                => url($this->image),
        ];
    }
}
