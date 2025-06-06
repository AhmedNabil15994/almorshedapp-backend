<?php

namespace App\Modules\Answers\Resources;

use Illuminate\Http\Resources\Json\Resource;

class AnswerResource extends Resource
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
            'id'          => $this->id,
            'answer'      => $this->answer,
            'value'       => $this->value,
        ];
    }
}
