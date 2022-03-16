<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class SeoRequest extends FormRequest
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
       
        $rules = [
            // 'meta_title' => 'required|string'
        ];
       return $rules; 
    }

    public function messages()
    {
        return [
            'meta_title.required' => 'Meta title is required'
        ];
    }
}
