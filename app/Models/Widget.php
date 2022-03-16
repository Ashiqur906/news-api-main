<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Widget extends Model
{
    use HasFactory , SoftDeletes;
    protected $fillable = ['name' , 'path' , 'widget_type', 'widget_limit' , 'status'];
}
