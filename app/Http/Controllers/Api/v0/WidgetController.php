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
use App\Http\Requests\PostRequest;
use App\Traits\ImageResizeTrait;
use File;
use App\Models\Widget;
use App\Http\Resources\Api\v0\WidgetResource;


class WidgetController extends Controller
{
    protected $user;
    public function __construct()
    {
        $this->user = JWTAuth::parseToken()->authenticate();
    }

    public function index()
    {     
        $widgets = Widget::OrderBy('id', 'asc')->get();
        return WidgetResource::Collection($widgets);

              
    }

    public function create()
    {   
       
    }


    public function store(Request $request)
    {
        $widget = new Widget();
        $widget->fill($request->all());
        $widget->save(); 
        return response(['Data Saved Successfully']);

    }


    public function show($path)
    {
        $widget = Widget::where('path' , $path)->firstOrfail();
        return  new WidgetResource($widget);
    }


    public function edit($path)
    {
        $widget = Widget::where('path' , $path)->firstOrfail();
        return  new WidgetResource($widget);
    }


    public function update(Request $request, $id)
    {
        $widget = Widget::findOrFail($id);

        try{
            $widget->fill($request->all());
            if($widget->save()){
                return response(['Data Updated Successfully']);
            }
          

        }catch(\Illuminate\Database\QueryException $ex){
            return response()->json([
                'Widget does not exists'
            ]);
        }
    }


    public function destroy($id)
    {
        $widget = Widget::findOrFail($id);
        try{
            $widget->delete();
            return response(['Data Deleted Successfully']);

        }catch(\Illuminate\Database\QueryException $ex){
            return response()->json([
                'Widget does not exists'
            ]);
        }
    }
    public function setting(Request $request)
    {
        return config('widget');
    }
}
