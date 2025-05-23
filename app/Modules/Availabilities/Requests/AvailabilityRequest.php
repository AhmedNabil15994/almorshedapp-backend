<?php

namespace App\Modules\Availabilities\Requests;

use Illuminate\Foundation\Http\FormRequest;

class AvailabilityRequest extends FormRequest
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
                  'doctor_id'         => 'required',
                  'available_from'    => 'required',
                  'available_to'      => 'required',
                ];

            //handle updates
            case 'put':
            case 'PUT':
                return [
                  'doctor_id'        => 'required',
                  'available_from'   => 'required',
                  'available_to'     => 'required',
                ];
        }
    }

    public function messages()
    {

        $v = [
          "doctor_id.required"        => __('dashboard.availabilities.validation.doctor_id.required'),
          "available_from.required"   => __('dashboard.availabilities.validation.available_from.required'),
          "available_to.required"   => __('dashboard.availabilities.validation.available_to.required'),
        ];

        return $v;
    }
}
