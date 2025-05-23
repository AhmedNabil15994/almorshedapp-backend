<?php

namespace App\Modules\Questions\Resources;

use App\Modules\Answers\Resources\AnswerResource;
use Illuminate\Http\Resources\Json\Resource;

class QuestionResource extends Resource
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
            'id'         => $this->id,
            'question'   => $this->question,
            'answers'    => AnswerResource::collection($this->answers),
        ];
    }
}
