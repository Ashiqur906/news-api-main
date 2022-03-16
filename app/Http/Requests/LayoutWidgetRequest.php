<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use App\Rules\LayoutWidgetUniqueRequest;

class LayoutWidgetRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return true;
    }

    
    public function rules()
    {
         
        // $rules = [
        //   'layout_id' => ['required' , new LayoutWidgetUniqueRequest],
        //   'widget_id' => ['required' , new LayoutWidgetUniqueRequest],
        //   'widget_space_id' => ['required' , new LayoutWidgetUniqueRequest],
        // ];
       
       return $rules[]; 
    }
}
