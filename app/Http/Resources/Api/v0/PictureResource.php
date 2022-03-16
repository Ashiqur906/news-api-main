<?php

namespace App\Http\Resources\Api\v0;

use Illuminate\Http\Resources\Json\JsonResource;

class PictureResource extends JsonResource
{
   
    public function toArray($request)
    {
        return [
            'id'                     => $this->id,
            'small'                  => asset('storage'.$this->small),
            'medium'                 => asset('storage'.$this->medium),
            'full'                   => asset('storage'.$this->full),
            'thumbnail'              => ($this->thumbnail)?asset('storage'.$this->thumbnail):asset('storage'.$this->full),
            'is_active'              => $this->is_active,
            'created_at'             => $this->created_at,
            'updated_at'             => $this->updated_at,
        ];
    }
}
