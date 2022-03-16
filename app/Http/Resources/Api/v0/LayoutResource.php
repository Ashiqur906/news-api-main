<?php

namespace App\Http\Resources\Api\v0;

use Illuminate\Http\Resources\Json\JsonResource;

class LayoutResource extends JsonResource
{
   
    public function toArray($request)
    {
        return [
            'id'                    => $this->id,
            'title'                 => $this->title,
            'path'                  => $this->path,
            'structure'             => json_decode($this->structure),
            'image'                 => asset('storage/'.$this->image),
            'status'                => $this->status,
            'created_at'            => $this->created_at,
            'updated_at'            => $this->updated_at,
        ];
    }
}
