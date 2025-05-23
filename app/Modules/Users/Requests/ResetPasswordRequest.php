<?php

namespace App\Modules\Users\Requests;

use Illuminate\Foundation\Http\FormRequest;

class ResetPasswordRequest extends FormRequest
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
          'password' => 'required',
          'new_password' => 'confirmed|min:6|max:16|different:password',
        ];
    }

    public function messages()
    {

        $v = [
            'password.required'        => __('api.auth.validation.password.required'),
            'new_password.min'             => __('api.auth.validation.new_password.min'),
            'new_password.max'             => __('api.auth.validation.new_password.max'),
            'new_password.confirmed'        => __('api.auth.validation.new_password.confirmed'),
            'new_password.different'        => __('api.auth.validation.new_password.different'),
        ];

        return $v;
    }
}
