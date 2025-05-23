<?php

namespace App\Modules\Categories\Requests;

use Illuminate\Foundation\Http\FormRequest;

class CategoryRequest extends FormRequest
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
                  'category_id'     => 'required',
                  'image'           => 'array|min:1|max:1',
                ];

            //handle updates
            case 'put':
            case 'PUT':
                return [
                    'title.*'          => 'required',
                    'category_id'      => 'required',
                    'image'            => 'array|min:1|max:1',
                ];
        }
    }

    public function messages()
    {

        $v = [
          "category_id.required" => __('dashboard.categories.validation.category_id.required'),
          "image.max"            => __('dashboard.categories.validation.image.max'),
        ];

        foreach ($this->get('title') as $key => $value){
          $v["title.".$key.".required"] = __('dashboard.categories.validation.title.required').' - '.$key.'';
        }


        return $v;
    }
}
