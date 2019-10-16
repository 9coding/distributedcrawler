<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UserLogin extends FormRequest {

    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize() {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules() {
        return [
            'user_email' => 'required|email|unique:users|max:30',
            'user_password' => 'required',
            'captcha_code' => 'required',
        ];
    }
    
    public function messages() {
        return [
            'user_email.required' => __('messages.please_input').__('messages.user_email'),
        ];
    }

}
