<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UpdateProfilesRequest extends FormRequest
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
        return [
            'Fname' => 'required',
            'Lname' => 'required',
            'username' => 'required',
            'Tel' => 'required',
            'email' => 'required',
            'image' => 'mimes:jpeg,jpg,png' 
            
        ];
    }

    public function messages()
    {
        return [
            'Fname.required' => 'fname',
            'Lname.required' => 'lname',
            'username.required' => 'username',
            'Tel.required'  => 'Tel',
            'email.required' => 'email',
            'image.mimes' => 'กรุณาเลือกไฟล์ภาพนามสกุล jpeg,jpg,png',
           
        ];
    }
}
