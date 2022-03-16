<?php

namespace App\Http\Controllers\Api\v0;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Tag;
use Illuminate\Support\Facades\Auth;
use JWTAuth;
use Tymon\JWTAuth\Exceptions\JWTException;
use Symfony\Component\HttpFoundation\Response;
use Illuminate\Support\Facades\Validator;
use App\Http\Requests\TagRequest;
use App\Http\Resources\Api\v0\TagResource;

class TagController extends Controller
{
    protected $user;
 
    public function __construct()
    {
        $this->user = JWTAuth::parseToken()->authenticate();
    }

    public function index()
    {
        $tag = Tag::orderBy('id' , 'desc')->get();
        $data['allTag'] = TagResource::Collection($tag);
        $tagActive =  Tag::filterByStatus()->get();
        $data['activeTag'] = TagResource::Collection($tagActive);

        return $data;
    }

   
    public function create()
    {
        //
    }

    
    public function store(TagRequest $request)
    {
        // dd($request->all());
        $tag  = new Tag();
        $tag->fill($request->all());

        if($tag->save()){
            $tag =  Tag::orderBy('id','desc')->get();
            $tags = TagResource::collection($tag);
            return response()->json($tags);
        }
        // $tag->save();
        // return response(['Data Saved Successfully']);  
    }

   
    public function show($slug)
    {
        return Tag::where('slug' , $slug)->firstOrfail();
    }

    
    public function edit($id)
    {
        $tag = Tag::findOrFail($id);
        return $tag;
    }

   
    public function update(TagRequest $request , $id)
    {
        $tag = Tag::findOrFail($id);
           
        try{
            $tag->fill($request->all());
            $tag->save();
            return response(['Data Updated Successfully']);     
            
        }catch(\Illuminate\Database\QueryException $ex){
            return response()->json([
                'tag does not exists'
            ]);
        }
    }

   
    public function destroy($id)
    {
        $tag = Tag::findOrFail($id);
        try{
            $tag->delete();
            return response(['Data Deleted Successfully']);     
            
        }catch(\Illuminate\Database\QueryException $ex){
            return response()->json([
                'tag does not exists'
            ]);
        }
    }
}
