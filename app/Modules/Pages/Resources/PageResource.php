<?php

namespace App\Modules\Pages\Resources;

use Illuminate\Http\Resources\Json\Resource;

class PageResource extends Resource
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
            'description'          => htmlView($this->description),
            'status'               => $this->status,
            'created_at'           => date('d-m-Y' , strtotime($this->created_at)),
        ];
    }
}
