<?php

namespace App\Modules\Permissions\Requests;

use Illuminate\Foundation\Http\FormRequest;

class PermissionRequest extends FormRequest
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
                  'name'          => 'required|unique:permissions,name',
                  'display_name'  => 'required',
                  'description.*' => 'required',
                ];

            //handle updates
            case 'put':
            case 'PUT':
                return [
                    'name'          => 'required|unique:permissions,name,'.$this->id.'',
                    'display_name'  => 'required',
                    'description.*' => 'required',
                ];
        }
    }

    public function messages()
    {

        $v = [
            'name.required'           => __('dashboard.permissions.validation.name.required'),
            'name.unique'             => __('dashboard.permissions.validation.name.unique'),

            'display_name.required'   => __('dashboard.permissions.validation.display_name.required'),
        ];

        foreach ($this->get('description') as $key => $value){
          $v["description.".$key.".required"] = __('dashboard.permissions.validation.description.required').' - '.$key.'';
        }

        return $v;
    }
}
