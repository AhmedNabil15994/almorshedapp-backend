<?php

namespace App\Modules\Doctors\Requests;

use Illuminate\Foundation\Http\FormRequest;

class LoginDoctorRequest extends FormRequest
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
                  'email'           => 'required',
                  'password'        => 'required|min:6',
                ];
        }
    }

    public function messages()
    {

        $v = [
            'email.required'        => __('api.auth.validation.email.required'),
            'password.required'     => __('api.auth.validation.password.required'),
            'password.min'          => __('api.auth.validation.password.min'),
        ];

        return $v;
    }
}
