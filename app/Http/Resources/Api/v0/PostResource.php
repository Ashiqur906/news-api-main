<?php

namespace App\Http\Resources\Api\v0;

use Illuminate\Http\Resources\Json\JsonResource;
class PostResource extends JsonResource
{
   
    public function toArray($request)
    {
        return [
            'id'                    => $this->id, 
            'title'                 => $this->title,
            'slug'                  => rawurldecode($this->slug),
            'short_description'     => $this->short_description,
            'description'           => $this->description,
            'video_link'            => $this->video_link,
            'status'                => $this->status,
            'created_at'            => $this->created_at,
            'updated_at'            => $this->updated_at, 
            'pictures'              => PictureResource::collection($this->pictures),
            'seo'                   => $this->seo ? new SeoResource($this->seo) : [],
            'categories'            => CategoryResource::collection($this->categories),
            'tags'                  => TagResource::collection($this->tags),
            'postMeta'              => PostMetaResource::collection($this->postMetas),
            'socials'               => SocialResource::collection($this->socials),
            'postDistrict'          => DistrictResource::collection($this->districts) 
        ];
    }
}
