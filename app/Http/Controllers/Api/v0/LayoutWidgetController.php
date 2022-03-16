<?php

namespace App\Http\Controllers\Api\v0;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\LayoutWidget;
use App\Http\Resources\Api\v0\LayoutWidgetResource;
use App\Http\Requests\LayoutWidgetRequest;
use Illuminate\Support\Facades\Validator;
use App\Models\Post;
use App\Models\Tag;
use App\Models\Category;




class LayoutWidgetController extends Controller
{
    
    public function index()
    {
        $LayoutWidget =  LayoutWidget::OrderBy('id' , 'asc')->get();
        return LayoutWidgetResource::collection($LayoutWidget);
    }

   
    public function create()
    {
        //
    }

    
    public function store(Request $request)
    {   
       
        $obj = new LayoutWidget();
        
        $data = $request->only('widget_type','taxonomy','data_limit','data');
    
        $obj->layout_id = $request->layout_id;
        $obj->widget_id = $request->widget_id;
        $obj->widget_space_id = $request->widget_space_id;
        $obj->widget_settings = json_encode($data);
        if($obj->save()){
            return json_encode($obj);
        }
    }

   
    public function show($id)
    {
        $LayoutWidget = LayoutWidget::where('layout_id', $id)->get();
        return LayoutWidgetResource::collection($LayoutWidget);
    }

    
    public function edit($id)
    {
        $LayoutWidget =  LayoutWidget::findOrFail($id);
        return new LayoutWidgetResource($LayoutWidget);
    }

    
    public function update(Request $request, $id)
    {   
       
        $obj = LayoutWidget::findOrFail($id);
        $data = $request->only('widget_type','taxonomy','data_limit','data');
        $obj->layout_id = $request->layout_id;
        $obj->widget_id = $request->widget_id;
        $obj->widget_space_id = $request->widget_space_id;
        $obj->widget_settings = json_encode($data);
        
        if($obj->update()){
            return json_encode($obj);
        }

    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
    //taxonomy wise data
    public function layoutWidget(Request $request){
        
        if($request->taxonomy == 'post'){
            return Post::latest()->take(15)->get();
        }elseif($request->taxonomy == 'tag'){
            return Tag::latest()->get();    
        }elseif($request->taxonomy == 'category'){
            return Category::latest()->get();    
        }elseif($request->taxonomy == 'category-tag'){
            $cat_tag['tag'] = Tag::latest()->get();  
            $cat_tag['category'] = Category::latest()->get();
            return $cat_tag; 
        }elseif($request->taxonomy == 'video'){
           return Post::whereNotNull('video_link')->latest()->take(15)->get();
        }
    }
   
     //taxonomy wise filter data
    public function filterData(Request $request){
        
        if ($request->taxonomy != ''){
          return  $post = Post::query()
                    ->whereLike(['title','short_description','description'], $request->taxonomy)->get();
        }
    }
}
