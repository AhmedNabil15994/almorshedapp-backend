<?php

namespace App\Modules\Articles\Resources;

use Illuminate\Http\Resources\Json\Resource;

class ArticleResource extends Resource
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
            'content'              => $this->content,
            'image'                => url($this->image),
        ];
    }
}
