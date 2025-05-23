<?php

namespace App\Modules\Pages\Requests;

use Illuminate\Foundation\Http\FormRequest;

class PageRequest extends FormRequest
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
                  'title.*'         => 'required',
                  'description.*'   => 'required',
                ];

            //handle updates
            case 'put':
            case 'PUT':
                return [
                    'title.*'          => 'required',
                    'description.*'    => 'required',
                ];
        }
    }

    public function messages()
    {

        $v = [ ];

        foreach ($this->get('title') as $key => $value){
          $v["title.".$key.".required"] = __('dashboard.pages.validation.title.required').' - '.$key.'';
        }

        foreach ($this->get('description') as $key => $value){
          $v["description.".$key.".required"] = __('dashboard.pages.validation.description.required').' - '.$key.'';
        }

        return $v;
    }
}
