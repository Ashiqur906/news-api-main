<?php

namespace App\Http\Resources\Api\v0;

use Illuminate\Http\Resources\Json\JsonResource;

class SeoResource extends JsonResource
{
   
    public function toArray($request)
    {
        return [
            'id'                     => $this->id,
            'title'                  => $this->title,
            'meta_title'             => $this->meta_title,
            'meta_description'       => $this->meta_description,
            'meta_keywords'          => $this->meta_keywords,
            'canonical_url'          => $this->canonical_url,
            'meta_type'              => $this->meta_type,
            'meta_image_link'        => $this->meta_image_link,
            'created_at'             => $this->created_at,
            'updated_at'             => $this->updated_at,
        ];
    }
}
