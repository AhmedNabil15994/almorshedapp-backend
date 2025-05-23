<?php

namespace App\Modules\Doctors\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class AddExceptionDateRequest extends FormRequest
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
        $todayDate = date('Y-m-d');

        switch ($this->getMethod())
        {
            // handle creates
            case 'post':
            case 'POST':

                return [
                  'off_from'          => 'required',
                  'off_to'            => 'required',
                  'off_date'          => 'required|date_format:Y-m-d|after_or_equal:'.$todayDate,
                ];

            //handle updates
            case 'put':
            case 'PUT':
                return [
                  'off_from'          => 'required',
                  'off_to'            => 'required',
                  'off_date'          => 'required|date_format:Y-m-d|after_or_equal:'.$todayDate,
                ];
        }
    }

    public function messages()
    {

        $v = [
          "off_from.required"         => __('api.availability-exceptions.validation.off_from.required'),
          "off_to.required"           => __('api.availability-exceptions.validation.off_to.required'),
          "off_date.required"         => __('api.availability-exceptions.validation.off_date.required'),
          "off_date.date_format"         => __('api.availability-exceptions.validation.off_date.date_format'),
          "off_date.after_or_equal"         => __('api.availability-exceptions.validation.off_date.after_or_equal'),
        ];

        return $v;
    }
}
