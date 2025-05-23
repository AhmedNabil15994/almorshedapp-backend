<?php

namespace App\Modules\Articles\Requests;

use Illuminate\Foundation\Http\FormRequest;

class ArticleRequest extends FormRequest
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
                  'content.*'       => 'required',
                  'image'           => 'required|array|min:1|max:1',
                ];

            //handle updates
            case 'put':
            case 'PUT':
                return [
                  'name.*'          => 'required',
                  'content.*'       => 'required',
                  'image'           => 'array|min:1|max:1',
                ];
        }
    }

    public function messages()
    {

        $v = [
          "name.required"        => __('dashboard.articles.validation.name.required'),
          "content.required"     => __('dashboard.articles.validation.content.required'),
          "image.required"       => __('dashboard.articles.validation.image.required'),
          "image.max"            => __('dashboard.articles.validation.image.max'),
        ];

        foreach ($this->get('name') as $key => $value){
          $v["name.".$key.".required"] = __('dashboard.articles.validation.name.required').' - '.$key.'';
        }

        foreach ($this->get('content') as $key => $value){
          $v["content.".$key.".required"] = __('dashboard.articles.validation.content.required').' - '.$key.'';
        }

        return $v;
    }
}
