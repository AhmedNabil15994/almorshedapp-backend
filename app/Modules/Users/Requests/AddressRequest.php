<?php

namespace App\Modules\Users\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Auth;

class AddressRequest extends FormRequest
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
        switch ($this->getMethod()) {
            // handle creates
            case 'post':
            case 'POST':

            return [
              'country'         => 'required',
              'city'            => 'required',
              'state'           => 'required',
              'address_1'       => 'required',
              'phone'           => 'required|numeric|digits_between:6,11',
              'email'           => 'required|email',
              'username'        => 'required',
            ];
        }
    }

    public function messages()
    {
        $v = [
          'username.required'       => __('front.checkout.validation.username.required'),
          'email.required'          => __('front.checkout.validation.email.required'),
          'phone.required'          => __('front.checkout.validation.mobile.required'),
          'phone.numeric'           => __('front.checkout.validation.mobile.numeric'),
          'phone.digits_between'    => __('front.checkout.validation.mobile.digits_between'),
          'country.required'        => __('front.checkout.validation.country.required'),
          'city.required'           => __('front.checkout.validation.city.required'),
          'state.required'          => __('front.checkout.validation.state.required'),
          'address.required'        => __('front.checkout.validation.address.required'),
        ];

        return $v;
    }
}
