<?php

namespace App\Modules\Governorates\Requests;

use Illuminate\Foundation\Http\FormRequest;

class GovernorateRequest extends FormRequest
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
                  'name'            => 'required|unique:roles,name',
                  'display_name.*'  => 'required',
                  'description.*'   => 'required',
                ];

            //handle updates
            case 'put':
            case 'PUT':
                return [
                    'name'            => 'required|unique:roles,name,'.$this->id.'',
                    'display_name.*'  => 'required',
                    'description.*'   => 'required',
                ];
        }
    }

    public function messages()
    {

        $v = [
            'name.required'           => __('dashboard.roles.validation.name.required'),
            'name.unique'             => __('dashboard.roles.validation.name.unique'),
        ];

        foreach ($this->get('display_name') as $key => $value){
          $v["display_name.".$key.".required"] = __('dashboard.roles.validation.display_name.required').' - '.$key.'';
        }

        foreach ($this->get('description') as $key => $value){
          $v["description.".$key.".required"] = __('dashboard.roles.validation.description.required').' - '.$key.'';
        }

        return $v;
    }
}
