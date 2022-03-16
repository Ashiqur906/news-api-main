<?php

namespace App\Http\Resources\Api\v0;

use Illuminate\Http\Resources\Json\JsonResource;

class PostMetaResource extends JsonResource
{
   
    public function toArray($request)
    {
        return [
            'id'                    => $this->id,
            'post_id'               => $this->post_id,
            'meta_key'              => $this->meta_key,
            'meta_value'            => $this->meta_value,
            'created_at'            => $this->created_at,
            'updated_at'            => $this->updated_at,
        ];
    }
}
