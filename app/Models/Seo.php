<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;


class Seo extends Model
{
    use HasFactory , SoftDeletes;
    protected $fillable = ['meta_title' , 'meta_description' , 'meta_keywords' ,'canonical_url' , 'meta_type' , 'meta_image_link'];
}
