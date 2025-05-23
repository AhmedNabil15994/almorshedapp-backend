<?php

namespace App\Modules\Languages\Resources;

use Illuminate\Http\Resources\Json\Resource;

class LanguageResource extends Resource
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
            'language'             => $this->language,
        ];
    }
}
