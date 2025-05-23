<?php

namespace App\Modules\Languages\Requests;

use Illuminate\Foundation\Http\FormRequest;

class LanguageRequest extends FormRequest
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
                  // 'title.*'      => 'required|unique:page_translations,title',
                  'name.*'          => 'required',
                  'language'        => 'required',
                ];

            //handle updates
            case 'put':
            case 'PUT':
                return [
                  'name.*'          => 'required',
                  'language'        => 'required',
                ];
        }
    }

    public function messages()
    {

        $v = [
          "name.required"        => __('dashboard.languages.validation.name.required'),
          "language.required"    => __('dashboard.languages.validation.language.required'),
        ];

        foreach ($this->get('name') as $key => $value){
          $v["name.".$key.".required"] = __('dashboard.languages.validation.name.required').' - '.$key.'';
        }

        return $v;
    }
}
