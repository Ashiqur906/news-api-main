<?php

namespace App\Http\Controllers\Api\v0;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Social;
use Illuminate\Support\Facades\Auth;
use JWTAuth;
use Tymon\JWTAuth\Exceptions\JWTException;
use Symfony\Component\HttpFoundation\Response;
use Illuminate\Support\Facades\Validator;
use App\Http\Requests\SocialRequest;
use File;
use Illuminate\Support\Facades\Storage;
use URL;
use App\Http\Resources\Api\v0\SocialResource;


class SocialController extends Controller
{
    protected $user;
 
    public function __construct()
    {
        $this->user = JWTAuth::parseToken()->authenticate();
    }
  
    public function index()
    {   
        $social =  Social::orderBy('id','desc')->get();
        
        return SocialResource::collection($social);
        
       
    }

    
    public function create()
    {
        
    }

   
    public function store(SocialRequest $request)
    {
            $social = new  Social();
            $social->fill($request->all());
            if($request->hasFile('logo')){
                $social->logo =  Storage::put('social-logo', $request->file('logo'));
            }
            

            if($social->save()){
                $social =  Social::orderBy('id','desc')->get();
                $socials = SocialResource::collection($social);
                return response()->json($socials);
            }
    }

    
    public function show($id)
    {
        //
    }

   
    
    public function edit($id)
    {   
       
        $result = Social::findOrFail($id);
        $social = new SocialResource($result);
        return $social;
    }

    
    public function update(Request $request, $id)
    {   
        $social = Social::findOrFail($id);
        $social->fill($request->all());
        $old_file = $social->logo;
        if($request->hasFile('logo')){
            if ($social->logo != null){
                $this->deleteFile($old_file);
            }
            $social->logo = Storage::put('social-logo', $request->file('logo'));
        }

        $social->update();
        return response(['Data Updated Successfully']); 
    }

    
    
    public function destroy($id)
    {
        $social = Social::findOrFail($id);
        $old_file = $social->logo;
        $social->delete(); 
        return response(['Data Deleted Successfully']);
    }

    private function deleteFile($path)
    {         
        if(Storage::exists($path)) {
            Storage::delete($path);
        }
    }
}
