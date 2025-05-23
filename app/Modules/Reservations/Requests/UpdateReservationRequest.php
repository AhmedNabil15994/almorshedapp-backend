<?php

namespace App\Modules\Reservations\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UpdateReservationRequest extends FormRequest
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
            'change_apponitment' => 'sometimes',
            'required_at' => 'required_with:change_apponitment,1',
            'availability_id' => 'required_with:change_apponitment,1',
        ];
    }

    public function messages()
    {

        $v = [
          "required_at.required_with"  => __('dashboard.reservations.validation.required_at.required'),
          "availability_id.required_with"  => __('dashboard.reservations.validation.availability_id.required'),
        ];

        return $v;
    }
}
