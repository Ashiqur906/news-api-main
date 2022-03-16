<?php

namespace App\Http\Resources\Api\v0;

use Illuminate\Http\Resources\Json\JsonResource;

class WidgetResource extends JsonResource
{
   
    public function toArray($request)
    {
        return [
            'id'                => $this->id,
            'name'              => $this->name,
            'path'              => $this->path,
            'widget_type'       => $this->widget_type,
            'limit_required'    => $this->limit_required,
            'collection_type'   => $this->collection_type,
            'taxonomy'          => $this->taxonomy,
            'status'            => $this->status,
            'created_at'        => $this->created_at,
            'updated_at'        => $this->updated_at,
        ];
    }
}
