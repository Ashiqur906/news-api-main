<?php

namespace App\Http\Resources\Api\v0;

use Illuminate\Http\Resources\Json\JsonResource;

class LayoutWidgetResource extends JsonResource
{
   
    public function toArray($request)
    {   

        return [
            'id'                    => $this->id,
            'layout_id'             => $this->layout_id,
            'widget_id'             => $this->widget_id,
            'widget_name'           => $this->widget->name,
            'widget_space_id'       => $this->widget_space_id,
            'widget_settings'       => json_decode($this->widget_settings),
            'status'                => $this->status,
            'created_at'            => $this->created_at,
            'updated_at'            => $this->updated_at,
            'deleted_at'            => $this->deleted_at,
        ];
    }
}
