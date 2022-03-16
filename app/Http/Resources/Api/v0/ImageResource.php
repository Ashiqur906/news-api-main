<?php

namespace App\Http\Resources\Api\v0;

use Illuminate\Http\Resources\Json\JsonResource;

class ImageResource extends JsonResource
{
   
    public function toArray($request)
    {
        return [
            'id'                    => $this->id,
            'name'                  => $this->name,
            'slug'                  => $this->slug,
            'status'                => $this->status,
            'image'                 => asset('storage/'.$this->url),
            'url'                   => asset('storage/'.$this->url),
            'created_at'            => $this->created_at,
            'updated_at'            => $this->updated_at,
        ];
    }
}
