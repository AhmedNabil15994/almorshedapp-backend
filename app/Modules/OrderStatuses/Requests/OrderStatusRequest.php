<?php

namespace App\Modules\OrderStatuses\Requests;

use Illuminate\Foundation\Http\FormRequest;

class OrderStatusRequest extends FormRequest
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
                  'title.*'          => 'required',
                  'code'            => 'required',
                ];

            //handle updates
            case 'put':
            case 'PUT':
                return [
                  'title.*'          => 'required',
                  'code'            => 'required',
                ];
        }
    }

    public function messages()
    {

        $v = [
          "title.required"        => __('dashboard.orderStatuses.validation.title.required'),
          "code.required"        => __('dashboard.orderStatuses.validation.code.required'),
        ];

        foreach ($this->get('title') as $key => $value){
          $v["title.".$key.".required"] = __('dashboard.orderStatuses.validation.title.required').' - '.$key.'';
        }

        return $v;
    }
}
