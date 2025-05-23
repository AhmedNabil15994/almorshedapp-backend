<?php

namespace App\Modules\Services\Requests;

use Illuminate\Foundation\Http\FormRequest;

class ServiceRequest extends FormRequest
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
                  'name.*'          => 'required',
                  //'price'           => 'required',
                  'description.*'   => 'required',
                  'image'           => 'required|array|min:1|max:1',
                ];

            //handle updates
            case 'put':
            case 'PUT':
                return [
                  'name.*'          => 'required',
                  //'price'           => 'required',
                  'description.*'   => 'required',
                  'image'           => 'array|min:1|max:1',
                ];
        }
    }

    public function messages()
    {

        $v = [
          "name.required"        => __('dashboard.services.validation.name.required'),
          //"price.required"   => __('dashboard.services.validation.price.required'),
          "description.required"     => __('dashboard.services.validation.description.required'),
          "image.required"       => __('dashboard.services.validation.image.required'),
          "image.max"            => __('dashboard.services.validation.image.max'),
        ];

        foreach ($this->get('name') as $key => $value){
          $v["name.".$key.".required"] = __('dashboard.services.validation.name.required').' - '.$key.'';
        }

        foreach ($this->get('description') as $key => $value){
          $v["description.".$key.".required"] = __('dashboard.services.validation.description.required').' - '.$key.'';
        }

        return $v;
    }
}
