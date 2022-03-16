<?php

namespace App\Http\Resources\Api\v0;

use Illuminate\Http\Resources\Json\JsonResource;

class CategoryResource extends JsonResource
{
   
    public function toArray($request)
    {
        return [
            'id'                    => $this->id,
            'title'                 => $this->title,
            'slug'                  => $this->slug,
            'status'                => $this->status,
            'isMenu'                => $this->isMenu,
            'created_at'            => $this->created_at,
            'updated_at'            => $this->updated_at,
            'seo'                   => new SeoResource($this->seo),
        ];
    }
}
