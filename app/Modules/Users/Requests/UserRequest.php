<?php

namespace App\Modules\Users\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UserRequest extends FormRequest
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
//                  'mobile'          => 'nullable|numeric',
                  'mobile'          => 'nullable|string|max:15',
                  'email'           => 'required|email|unique:users,email',
                  'password'        => 'required|min:6|confirmed',
                  'image'           => 'array|min:1|max:1',
                ];

            //handle updates
            case 'put':
            case 'PUT':
                return [
                    'name'            => 'required',
//                    'mobile'          => 'nullable|numeric',
                    'mobile'          => 'nullable|string|max:15',
                    'email'           => 'required|email|unique:users,email,'.$this->id.'',
                    'password'        => 'nullable|min:6|confirmed',
                    'image'           => 'array|min:1|max:1',
                ];
        }
    }

    public function messages()
    {

        $v = [
            'name.required'           => __('dashboard.users.validation.name.required'),
            'email.required'          => __('dashboard.users.validation.email.required'),
            'email.unique'            => __('dashboard.users.validation.email.unique'),
            'email.email'            => __('dashboard.users.validation.email.email'),
            'mobile.required'         => __('dashboard.users.validation.mobile.required'),
            'mobile.numeric'          => __('dashboard.users.validation.mobile.numeric'),
            'password.required'       => __('dashboard.users.validation.password.required'),
            'password.min'            => __('dashboard.users.validation.password.min'),
            'password.confirmed'      => __('dashboard.users.validation.password.confirmed'),
            "image.max"               => __('dashboard.users.validation.image.max'),
        ];

        return $v;
    }
}
