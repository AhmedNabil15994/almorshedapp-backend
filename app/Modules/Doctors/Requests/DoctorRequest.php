<?php

namespace App\Modules\Doctors\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class DoctorRequest extends FormRequest
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
                  'name.*'                => 'required',
//                  'mobile'              => 'required|numeric',
                  'mobile'              => 'required|string|max:15',
                  'email'               => 'required|email|unique:users,email',
                  'password'            => 'required|min:6|confirmed',
                  'avatar'               => 'array|min:1|max:1',
                  'academic_degree.*'     => 'required',
                  'current_workplaces.*'  => 'required',
                  'previous_experience.*' => 'required',
                  'specialization.*'      => 'required',
                  'languages'         => 'required',
                ];

            //handle updates
            case 'put':
            case 'PUT':
                return [
                    'name.*'            => 'required',
//                    'mobile'          => 'required|numeric',
                    'mobile'          => 'required',
                    'email'           => ['required', 'email'],
                    'password'        => 'nullable|min:6|confirmed',
                    'avatar'           => 'array|min:1|max:1',
                    'academic_degree.*'     => 'required',
                    'current_workplaces.*'  => 'required',
                    'previous_experience.*' => 'required',
                    'specialization.*'      => 'required',
                    'languages'         => 'required',
                ];
        }
    }

    public function messages()
    {

        $v = [
            'name.required'           => __('dashboard.doctors.validation.name.required'),
            'email.required'          => __('dashboard.doctors.validation.email.required'),
            'email.unique'            => __('dashboard.doctors.validation.email.unique'),
            'email.email'            => __('dashboard.doctors.validation.email.email'),
            'mobile.required'         => __('dashboard.doctors.validation.mobile.required'),
            'mobile.numeric'          => __('dashboard.doctors.validation.mobile.numeric'),
            'password.required'       => __('dashboard.doctors.validation.password.required'),
            'password.min'            => __('dashboard.doctors.validation.password.min'),
            'password.confirmed'      => __('dashboard.doctors.validation.password.confirmed'),
            "avatar.max"               => __('dashboard.doctors.validation.image.max'),
            'academic_degree.required'         => __('dashboard.doctors.validation.academic_degree.required'),
            'current_workplaces.required'      => __('dashboard.doctors.validation.current_workplaces.required'),
            'previous_experience.required'     => __('dashboard.doctors.validation.previous_experience.required'),
            'specialization.required'          => __('dashboard.doctors.validation.specialization.required'),
            'languages.required'             => __('dashboard.doctors.validation.languages.required'),
        ];

        foreach ($this->get('name') as $key => $value) {
            $v["name." . $key . ".required"] = __('dashboard.doctors.validation.name.required') . ' - ' . $key . '';
        }

        foreach ($this->get('academic_degree') as $key => $value) {
            $v["academic_degree." . $key . ".required"] = __('dashboard.doctors.validation.academic_degree.required') . ' - ' . $key . '';
        }

        foreach ($this->get('current_workplaces') as $key => $value) {
            $v["current_workplaces." . $key . ".required"] = __('dashboard.doctors.validation.current_workplaces.required') . ' - ' . $key . '';
        }

        foreach ($this->get('previous_experience') as $key => $value) {
            $v["previous_experience." . $key . ".required"] = __('dashboard.doctors.validation.previous_experience.required') . ' - ' . $key . '';
        }

        foreach ($this->get('specialization') as $key => $value) {
            $v["specialization." . $key . ".required"] = __('dashboard.doctors.validation.specialization.required') . ' - ' . $key . '';
        }

        return $v;
    }
}
