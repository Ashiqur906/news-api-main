<?php

namespace App\Http\Controllers\Api\v0;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Setting;
use File;
use Illuminate\Support\Facades\Storage;
use App\Http\Resources\Api\v0\SettingResource;


class SettingController extends Controller
{
    
    public function index()
    {   
        $settings = Setting::get();
        return SettingResource::collection($settings);
    }

   
    public function create()
    {
        //
    }

    
    public function store(Request $request)
    {   
        
        foreach($request->all() as $key => $val){
                     
            $set = Setting::where('key' , $key)->first();
            if(empty($set)){
                $set = new Setting();
            }
            $set->key = $key;
            if($request->hasFile($key) || $request->file($key)){
            $set->value =  Storage::put('settings', $request->file($key));
            } else {
            $set->value = $val;
            }
            $set->save();
               
        }
        
        $settings = Setting::get();

        return SettingResource::collection($settings);
  
    }

    
    public function show($id)
    {
        //
    }

  
    public function edit($id)
    {
        //
    }

   
    public function update(Request $request, $id)
    {
        
    }

  
    public function destroy($id)
    {
        //
    }
}
