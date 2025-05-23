<?php

namespace App\Modules\Ratings\Requests;

use Illuminate\Validation\Rule;
use Illuminate\Foundation\Http\FormRequest;

class RatingRequest extends FormRequest
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
          'doctor_id'  => 'required',
          'rating'     => ['required' , 'integer', 
              Rule::in([1, 2, 3, 4, 5]),
          ],
        ];
    }

    public function messages()
    {

        $v = [
          "doctor_id.required"        => __('api.ratings.validation.doctor_id.required'),
          "rating.required"        => __('api.ratings.validation.rating.required'),
          "rating.integer"        => __('api.ratings.validation.rating.integer'),
        ];

        return $v;
    }
}
