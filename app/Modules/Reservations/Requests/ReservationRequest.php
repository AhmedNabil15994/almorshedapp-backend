<?php

namespace App\Modules\Reservations\Requests;

use Illuminate\Foundation\Http\FormRequest;

class ReservationRequest extends FormRequest
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
             //handle creates
            case 'post':
            case 'POST':

                return [
                  'date'                => 'required|date_format:Y-m-d|after_or_equal:'.$todayDate,
                  'doctor_id'           => 'required|exists:doctors,id',
                  'service_id'          => 'required|exists:services,id',
                  'availability_id'     => ['required','exists:availabilities,id', new \App\Rules\AvailabilitiyDate($this->date)]
                ];

            //handle updates
            case 'put':
            case 'PUT':
                return [
                  'notes'          => 'required',
                ];
        }
    }

    public function messages()
    {

        $v = [
          "date.required"             => __('api.reservations.validation.date.required'),
          "date.date_format"          => __('api.reservations.validation.date.date_format'),
          "date.after_or_equal"       => __('api.reservations.validation.date.after_or_equal'),
          "doctor_id.required"        => __('api.reservations.validation.doctor_id.required'),
          "service_id.required"       => __('api.reservations.validation.service_id.required'),
          "notes.required"            => __('api.reservations.validation.notes.required'),
        ];

        return $v;
    }
}
