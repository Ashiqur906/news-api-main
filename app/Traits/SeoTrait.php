<?php
namespace App\Traits;
use App\Models\Picture;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Intervention\Image\Facades\Image;
use App\Models\Post;
use App\Models\Seo;

trait SeoTrait{

    
    public function seo($request , $id ,  $model)
    {        
        
            $seo = Seo::where('seoable_id' , $id)->first();
            if(empty($seo)){
                $seo = new Seo();
                $seo->fill($request->all());
                $seo->seoable_id = $id;
                $seo->seoable_type = $model;
                $seo->save();
            } else {
                $seo->fill($request->all());
                $seo->seoable_id = $id;
                $seo->seoable_type = $model;
                $seo->save();
            }

    }  


}