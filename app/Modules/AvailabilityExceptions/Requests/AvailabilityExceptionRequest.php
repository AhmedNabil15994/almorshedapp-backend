<?php

namespace App\Modules\AvailabilityExceptions\Requests;

use Illuminate\Foundation\Http\FormRequest;

class AvailabilityExceptionRequest extends FormRequest
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
                  'off_from'          => 'required',
                  'off_to'            => 'required',
                  'off_date'          => 'required',
                ];

            //handle updates
            case 'put':
            case 'PUT':
                return [
                  'doctor_id'        => 'required',
                  'off_from'         => 'required',
                  'off_to'           => 'required',
                  'off_date'         => 'required',
                ];
        }
    }

    public function messages()
    {

        $v = [
          "doctor_id.required"        => __('dashboard.availability-exceptions.validation.doctor_id.required'),
          "off_from.required"         => __('dashboard.availability-exceptions.validation.off_from.required'),
          "off_to.required"           => __('dashboard.availability-exceptions.validation.off_to.required'),
          "off_date.required"         => __('dashboard.availability-exceptions.validation.off_date.required')
        ];

        return $v;
    }
}
