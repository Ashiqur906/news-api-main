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
use App\Traits\SeoTrait;
use File;
use App\Http\Resources\Api\v0\PostResource;
use App\Http\Resources\Api\v0\CategoryResource;
use App\Http\Resources\Api\v0\PictureResource;
use App\Models\Seo;
use App\Models\PostMeta;
use App\Models\Category;
use App\Models\Social;
use App\Models\Tag;

class PostController extends Controller
{
    use ImageResizeTrait , SeoTrait;
    protected $user;
    public function __construct()
    {
        $this->user = JWTAuth::parseToken()->authenticate();
    }
  
    public function index()
    {
       $post = Post::orderBy('id' , 'desc')->paginate(15);
       return $data['posts'] =  PostResource::collection($post);
    }

   
    public function create()
    {
        //                 
    }

   
    public function store(PostRequest $request)
    {   
        // return response($request->social_id);
        $post  = new Post();                                         
        $post->fill($request->all());
        $post->slug = rawurlencode($request->slug);
        if($post->save()) {
            $model = Post::class;
            $this->seo($request , $post->id ,  $model);

            $district_id = $request->district_id;
            $post->districts()->sync($district_id);

            $tag_ids = $request->tag_id;            
            $post->tags()->sync($tag_ids);
            $this->tagStatus($tag_ids);

            $social_ids = $request->social_id;            
            $post->socials()->sync($social_ids);
            $this->socialStatus($social_ids);

            $category_ids = $request->category_id;
            $post->categories()->sync($category_ids);
            $this->catStatus($category_ids);
         
            $this->postMeta($request, $post->id);
            $pictures = ($request->thumbnail) ? $request->thumbnail : [];
            $existing_id = null;
            if (!empty($pictures)) {
                foreach ($pictures as $list) {
                    $this->upload($list , $post->id , $existing_id);
                }
            }
            return response(['Data Saved Successfully']);
        }  
    
       
    }

    
    public function show($slug)
    {   
        $slug = rawurlencode($slug);
        $post = Post::where('slug' , $slug)->firstOrfail();
        $data['post'] = new PostResource($post);
        return $data;
    }

    
    public function edit($id)
    {
        $post = Post::findOrFail($id);
        $data['post'] = new PostResource($post);
        return  $data;
    }

   
    public function update(PostRequest $request, $id)
    {   
        // return response($request->social_id);
        $post = Post::findOrFail($id);
           
        try{
            $post->fill($request->all());
            $post->slug = rawurlencode($request->slug);
            if($post->save()) {
                $this->postMeta($request, $post->id);
                $model = Post::class;
                $this->seo($request , $post->id ,  $model); 
                
                $district_id = $request->district_id;
                $post->districts()->sync($district_id);

                $tag_ids = $request->tag_id; 
                $post->tags()->sync($tag_ids);
                $this->tagStatus($tag_ids);

                $category_ids = $request->category_id;
                $post->categories()->sync($category_ids);
                $this->catStatus($category_ids);

                $social_ids = $request->social_id;            
                $post->socials()->sync($social_ids);
                $this->socialStatus($social_ids);

                $pictures = ($request->thumbnail) ? $request->thumbnail : [];
                $existing_id = null;
                if (!empty($pictures)) {
                    foreach ($pictures as $list) {
                        $this->upload($list , $post->id , $existing_id);
                    }
                }
            }  
            return response(['Data Updated Successfully']);     
            
        }catch(\Illuminate\Database\QueryException $ex){
            return response()->json([
                'Post does not exists'
            ]);
        }
    }

   
    public function destroy($id)
    {   
        $post = Post::findOrFail($id);
        try{
            $post->delete();
            return response(['Data Deleted Successfully']);     
            
        }catch(\Illuminate\Database\QueryException $ex){
            return response()->json([
                'Post does not exists'
            ]);
        }
    }

    private function metaInfo($request , $post_id){
           
            $metaInfo = MetaInfo::where('post_id' , $post_id)->first();
            if(empty($metaInfo)){
                $metaInfo = new MetaInfo();
                $metaInfo->fill($request->all());
                $metaInfo->post_id = $post_id;
                $metaInfo->save();
            } else {
                $metaInfo->fill($request->all());
                $metaInfo->post_id = $post_id;
                $metaInfo->save();
            }
       
    }

    private function postMeta($request , $post_id){
       
        
       $postMeta = PostMeta::where('post_id' , $post_id)->first();
        if(empty($postMeta)){
           $this->postMetaExecution($request , $post_id);
        }else{
            PostMeta::where('post_id' , $post_id)->delete();
            $this->postMetaExecution($request , $post_id);
        }
   
    }

    private function postMetaExecution($request , $post_id){
        if($request->meta_key){
            if (count($request->meta_key) > 0) {
                $counts = count($request->meta_key);
                for($i = 0; $i < $counts; $i++){
                    $meta_post = new PostMeta();  
                    $meta_post->post_id = $post_id;
                    $meta_post->meta_key = $request->meta_key[$i];
                    $meta_post->meta_value = $request->meta_value[$i];
                    $meta_post->save();   
                }
            }
        }    
    }

    private function tagStatus($tag_ids){
        if($tag_ids){
            for($i=0; $i<count($tag_ids);$i++) {
                $cat = Tag::search($tag_ids[$i]); 
                $cat->status =  1;
                $cat->save();
            }
        }    
    }

    private function catStatus($category_ids){
        if($category_ids){
            for($i=0; $i<count($category_ids);$i++) {
                $cat = Category::search($category_ids[$i]);
                $cat->status =  1;
                $cat->save();
            }
        }
    }
    private function socialStatus($social_ids){
        if($social_ids){
            for($i=0; $i<count($social_ids);$i++) {
                $social = Social::search($social_ids[$i]);
                $social->save();
            }
        }
    }
}
