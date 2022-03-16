<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class SocialRequest extends FormRequest
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
            'title' => 'required|string|unique:socials,title,'. $this->id,
            'slug' => 'required|unique:socials,slug,'. $this->id,
            'url' => 'required|unique:socials,url,'. $this->id,
        ];
       
       return $rules; 
    }
}
