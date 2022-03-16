<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Widget;

class LayoutWidget extends Model
{
    use HasFactory;
    protected $fillable = ['layout_id' , 'widget_id' , 'widget_settings'];

    public function widget(){
       return  $this->belongsTo(Widget::class)->select('name');
    }
}
