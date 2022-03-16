<?php

namespace App\Http\Controllers\Api\v0;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Seo;
use Illuminate\Support\Facades\Auth;
use JWTAuth;
use Tymon\JWTAuth\Exceptions\JWTException;
use Symfony\Component\HttpFoundation\Response;
use Illuminate\Support\Facades\Validator;
use App\Http\Requests\SeoRequest;

class SeoController extends Controller
{
    protected $user;
 
    public function __construct()
    {
        $this->user = JWTAuth::parseToken()->authenticate();
    }
    
    public function index()
    {
        $seo = Seo::orderBy('id' , 'desc')->get();
        return $seo;
    }

  
    public function create()
    {
        //
    }
 
   
    public function store(SeoRequest $request)
    {
        $seo  = new Seo();
        $seo->fill($request->all());
        $seo->save();
        return response(['Data Saved Successfully']);     
    }

    public function show($slug)
    { 
        return Seo::where('slug' , $slug)->firstOrfail();
    }

   
    public function edit($id)
    {
        $seo = Seo::findOrFail($id);
        return $seo;
    }

    
    public function update(SeoRequest $request, $id)
    {
        $seo = Seo::findOrFail($id);
           
        try{
            $seo->fill($request->all());
            $seo->save();
            return response(['Data Updated Successfully']);     
            
        }catch(\Illuminate\Database\QueryException $ex){
            return response()->json([
                'Seo does not exists'
            ]);
        }
    }

    
    public function destroy($id)
    {
        $seo = Seo::findOrFail($id);
        try{
            $seo->delete();
            return response(['Data Deleted Successfully']);     
            
        }catch(\Illuminate\Database\QueryException $ex){
            return response()->json([
                'Seo does not exists'
            ]);
        }
    }
}
