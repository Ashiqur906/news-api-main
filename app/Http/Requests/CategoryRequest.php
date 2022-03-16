<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class CategoryRequest extends FormRequest
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

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        // dd($this->id);
        $rules = [
             'title' => 'required|string|unique:categories,title,'. $this->id,
             'slug' => 'required|unique:categories,slug,'. $this->id
        ];
        
        return $rules; 
    }

    public function messages()
    {
        return [
            'title.required' => 'Title is required',
            'slug.required' => 'Slug is required',
        ];
    }
}
