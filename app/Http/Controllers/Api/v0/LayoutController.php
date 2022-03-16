<?php

namespace App\Http\Controllers\Api\v0;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Post;
use App\Models\Picture;
use Illuminate\Support\Facades\Auth;
use JWTAuth;
use Tymon\JWTAuth\Exceptions\JWTException;
use Symfony\Component\HttpFoundation\Response;
use Illuminate\Support\Facades\Validator;
use App\Http\Requests\LayoutRequest;
use App\Traits\ImageResizeTrait;
use File;
use App\Models\Layout;
use App\Models\Widget;
use Illuminate\Support\Facades\Storage;
use App\Http\Resources\Api\v0\LayoutResource;

class LayoutController extends Controller
{
    protected $user;
    public function __construct()
    {
        $this->user = JWTAuth::parseToken()->authenticate();
    }
    
    public function index()
    {
        $layouts =  Layout::OrderBy('id' , 'asc')->get();
        return LayoutResource::collection($layouts);
    }

    public function create()
    {
        
    }

   
    public function store(LayoutRequest $request)
    {   
       
        $data = json_decode($request->structure);
       
        $layout  = new  Layout();
        $layout->title = $data->layout_name;
        $layout->path = $data->layout_slug;
        $layout->structure = $request->structure;
        if($request->hasFile('image')){

            $layout->image =  Storage::put('layout-image', $request->file('image'));
        }
        $layout->save();
        return response(['Data Saved Successfully']); 
    }

   
    public function show($id)
    {
        $layout =  Layout::findOrFail($id);
        return new LayoutResource($layout);
    }

   
    public function edit($id)
    {   
        
        $layout =  Layout::findOrfail($id);
        return new LayoutResource($layout);
    }

  
    public function update(LayoutRequest $request, $id)
    {
        $layout = Layout::findOrFail($id);
        
        try{
            $layout->fill($request->all());
            $old_file = $layout->image;
            if($request->hasFile('image')){
                if ($layout->image != null){
                    $this->deleteFile($old_file);
                }
                $layout->image = Storage::put('layout-image', $request->file('image'));
            }
            $layout->save();
            return response(['Data Updated Successfully']);     
            
        }catch(\Illuminate\Database\QueryException $ex){
            return response()->json([
                'Layout does not exists'
            ]);
        }
    }

   
    public function destroy($id)
    {
        $layout = Layout::findOrFail($id);
        
        try{
                if($layout->image != null){
                    $this->deleteFile($layout->image);
                }

                $layout->delete();
                return response(['Data Deleted Successfully']);     
            
        }catch(\Illuminate\Database\QueryException $ex){
            return response()->json([
                'Layout does not exists'
            ]);
        }
    }

    private function deleteFile($path)
    {         
        if(Storage::exists($path)) {
            Storage::delete($path);
        }
    }

    public function status(Request $request){   
        
        $layout = Layout::where('path' , $request->path)->firstOrFail();
        $results = Layout::all()->except([$layout->id]);
        foreach($results as $list){
            $list->status = 0;  
            $list->save();  
        }
        $layout->status = 1;
        $layout->save();
        
        $layouts = Layout::OrderBy('id' , 'asc')->get();
        return LayoutResource::collection($layouts);
    }
}
