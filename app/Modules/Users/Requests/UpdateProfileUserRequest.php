<?php

namespace App\Modules\Users\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Auth;

class UpdateProfileUserRequest extends FormRequest
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
        switch ($this->getMethod()) {
            // handle creates
            case 'post':
            case 'POST':

                return [
                  'name'            => 'required',
//                  'mobile'          => 'required|numeric|digits_between:6,11',
                  'calling_code'    => 'required|string|max:10',
                  'mobile'          => 'required|string|max:15',
                  'email'           => 'required|email|unique:users,email,'.Auth::user()->id.'',
                  'password'        => 'nullable|min:6|same:password_confirmation',
                  'avatar'          => 'sometimes|image|mimes:jpeg,jpg,png|required|max:2048',
                ];
        }
    }

    public function messages()
    {
        $v = [
          'name.required'           => __('api.auth.validation.name.required'),
          'email.required'          => __('api.auth.validation.email.required'),
          'email.unique'            => __('api.auth.validation.email.unique'),
          'email.email'             => __('api.auth.validation.email.email'),
          'calling_code.required'    => __('api.auth.validation.calling_code.required'),
          'mobile.required'          => __('api.auth.validation.mobile.required'),
          'mobile.numeric'           => __('api.auth.validation.mobile.numeric'),
          'mobile.digits_between'    => __('api.auth.validation.mobile.digits_between'),
          'password.min'            => __('api.auth.validation.password.min'),
          'password.same'           => __('api.auth.validation.password.confirmed'),
        ];

        return $v;
    }
}
