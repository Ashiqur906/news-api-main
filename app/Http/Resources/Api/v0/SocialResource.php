<?php

namespace App\Http\Resources\Api\v0;

use Illuminate\Http\Resources\Json\JsonResource;

class SocialResource extends JsonResource
{
   
    public function toArray($request)
    {
         return [
             'id'                    => $this->id,
             'title'                 => $this->title,
             'slug'                  => $this->slug,
             'url'                   => $this->url,
             'logo'                  => asset('storage/'.$this->logo),
             'isActive'              => $this->isActive,
             'created_at'            => $this->created_at,
             'updated_at'            => $this->updated_at,
         ];
    }
}
