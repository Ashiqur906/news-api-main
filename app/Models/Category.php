<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use App\Models\Seo;
use Illuminate\Database\Eloquent\Scope;


class Category extends Model
{
    use HasFactory , SoftDeletes;
    protected $fillable = ['title' , 'slug' , 'status','isMenu'];

    public function seo(){
        return $this->morphOne(Seo::class, 'seoable'); 
    }

    public function scopeSearch($query, $catId)
    {
        return $query->findOrFail($catId);
    }

    public function scopeFilterByStatus($query)
    {
        return $query->where('status', 1);
    }
    
}
