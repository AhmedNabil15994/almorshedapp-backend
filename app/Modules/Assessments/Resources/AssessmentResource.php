<?php

namespace App\Modules\Assessments\Resources;

use Illuminate\Http\Resources\Json\Resource;

class AssessmentResource extends Resource
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
            'name'         => $this->name,
            'description'  => $this->description,
            'image'        => url($this->image),
        ];
    }
}
