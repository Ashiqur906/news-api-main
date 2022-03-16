<?php

namespace App\Http\Controllers\Api\v0;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Category;
use Illuminate\Support\Facades\Auth;
use JWTAuth;
use Tymon\JWTAuth\Exceptions\JWTException;
use Symfony\Component\HttpFoundation\Response;
use Illuminate\Support\Facades\Validator;
use App\Http\Requests\CategoryRequest;
use App\Traits\SeoTrait;
use App\Http\Resources\Api\v0\CategoryResource;

class CategoryController extends Controller
{   
    use SeoTrait;
    protected $user;

    public function __construct()
    {
        $this->user = JWTAuth::parseToken()->authenticate();
    }

    public function index()
    {   
        $category = Category::orderBy('id' , 'desc')->get();
        $data['allCategory'] = CategoryResource::Collection($category);
        $categoryActive =  Category::filterByStatus()->get();
        $data['activeCategory'] = CategoryResource::Collection($categoryActive);

        return $data;
    }

   
    public function create()
    {
        //
    }

   
    public function store(CategoryRequest $request)
    {
        $cat  = new Category();
        $cat->fill($request->all());
        if($cat->save()){
            $model = Category::class;
            $this->seo($request , $cat->id , $model);
            return response(['Data Saved Successfully']);
        }
    
       
    }

    
    public function show($slug)
    {
        $category = Category::where('slug' , $slug)->firstOrfail();
        return  new CategoryResource($category);
    }

    
    public function edit($id)
    {
        $category =  Category::findOrFail($id);
        return  new CategoryResource($category);
    }

   
    public function update(CategoryRequest $request, $id)
    {  
        
        $cat = Category::findOrFail($id);

        try{
            $cat->fill($request->all());
            if($cat->save()){
                $model = Category::class;
                $this->seo($request , $cat->id , $model);
                return response(['Data Updated Successfully']);
            }
          

        }catch(\Illuminate\Database\QueryException $ex){
            return response()->json([
                'Category does not exists'
            ]);
        }
    }

    
    public function destroy($id)
    {
        $cat = Category::findOrFail($id);
        try{
            $cat->delete();
            return response(['Data Deleted Successfully']);

        }catch(\Illuminate\Database\QueryException $ex){
            return response()->json([
                'Category does not exists'
            ]);
        }
    }
}
