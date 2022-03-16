<?php

namespace App\Http\Resources\Api\v0;

use Illuminate\Http\Resources\Json\JsonResource;

class SettingResource extends JsonResource
{   

    public function toArray($request)
    {
        if(($this->key == 'bg_image') || ($this->key == 'bd_image') || ($this->key == 'app_store') || ($this->key == 'play_store')) {
            $val = asset('storage/'.$this->value);
        }else{
            $val = $this->value;
        }
        
        return [
            'id'                     => $this->id,
            'key'                    => $this->key,
            'value'                  => $val,
            'created_at'             => $this->created_at,
            'updated_at'             => $this->updated_at,
        ];
    }
}
