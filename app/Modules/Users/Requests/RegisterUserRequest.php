<?php

namespace App\Modules\Users\Requests;

use Illuminate\Foundation\Http\FormRequest;

class RegisterUserRequest extends FormRequest
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
        switch ($this->getMethod())
        {
            // handle creates
            case 'post':
            case 'POST':

                return [
                  'name'            => 'required',
//                  'mobile'          => 'nullable|numeric|digits_between:6,11',
                  'calling_code'    => 'nullable|string|max:10',
                  'mobile'          => 'nullable|string|max:15',
                  'email'           => 'required|email|unique:users,email',
                  'password'        => 'required|min:6|same:password_confirmation',
                  'avatar'          => 'nullable|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
                ];
        }
    }

    public function messages()
    {

        $v = [
            'name.required'            => __('api.auth.validation.name.required'),
            'email.required'           => __('api.auth.validation.email.required'),
            'email.unique'             => __('api.auth.validation.email.unique'),
            'email.email'              => __('api.auth.validation.email.email'),
            'mobile.required'          => __('api.auth.validation.mobile.required'),
            'mobile.numeric'           => __('api.auth.validation.mobile.numeric'),
            'password.required'        => __('api.auth.validation.password.required'),
            'password.min'             => __('api.auth.validation.password.min'),
            'password.same'            => __('api.auth.validation.password.confirmed'),          
            'mobile.digits_between'    => __('api.auth.validation.mobile.digits_between'),
            'avatar.image'             => __('api.auth.validation.avatar.image'),
            'avatar.mimes'             => __('api.auth.validation.avatar.mimes'),
            'avatar.max'               => __('api.auth.validation.avatar.max'),
        ];

        return $v;
    }
}
