<?php

namespace App\Modules\Assessments\Resources;

use Illuminate\Http\Resources\Json\Resource;

class ResultResource extends Resource
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
            'id'           => $this->id,
            'rank'         => $this->rank,
            'message'      => $this->message,
        ];
    }
}
