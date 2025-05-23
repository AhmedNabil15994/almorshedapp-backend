<?php

namespace App\Modules\Doctors\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class UpdateDoctorRequest extends FormRequest
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
            'name'            => 'required',
//            'mobile'          => 'required|numeric',
            'mobile'          => 'required|string|max:15',
            'email'           => ['required', 'email',
            Rule::unique('users')->ignore(auth()->user()->id)],
            //'password'        => 'nullable|min:6|confirmed',
            //'avatar'           => 'array|min:1|max:1',
            'academic_degree'     => 'required',
            'current_workplaces'  => 'required',
            'previous_experience' => 'required',
            'specialization'      => 'required',
            'languages'         => 'required',
        ];

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

        return $v;
    }
}
