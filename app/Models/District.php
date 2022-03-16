<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Scopes\Desc;
class District extends Model
{
    use HasFactory;

    protected static function booted(){
        parent::boot();
        static::addGlobalScope(new Desc);
    }
}
