<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use App\Models\Category;
use App\Models\Tag;
use App\Models\Picture;
use App\Models\Seo;
use App\Models\Social;
use App\Models\PostMeta;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Scope;

class Post extends Model
{
    use HasFactory , SoftDeletes;
    protected $fillable = ['title' , 'slug' ,'short_description', 'description' ,'video_link','status'];


    public function categories()
    {
        return $this->belongsToMany(Category::class,'post_categories','post_id','category_id');
    }

    public function pictures(){
        return $this->morphMany(Picture::class, 'imageable'); 
    }

    public function seo(){
        return $this->morphOne(Seo::class, 'seoable'); 
    }

    public function tags(){
        return $this->belongsToMany(Tag::class, 'post_tags' , 'post_id' , 'tag_id'); 
    }

    public function postMetas(){
        return $this->hasMany(PostMeta::class,'post_id','id'); 
    }

    public function districts()
    {
        return $this->belongsToMany(District::class,'post_districts','post_id','district_id');
    }

    public function socials()
    {
        return $this->belongsToMany(Social::class,'post_socials','post_id','social_id');
    }

    
}
