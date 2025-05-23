<?php

namespace App\Modules\Ads\Requests;

use Illuminate\Foundation\Http\FormRequest;

class AdRequest extends FormRequest
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
                  'link'            => 'required|url',
                  'start_date'      => 'required',
                  'end_date'        => 'required|after:start_date',
                  'image'           => 'required|array|min:1|max:1',
                ];

            //handle updates
            case 'put':
            case 'PUT':
                return [
                  'name.*'          => 'required',
                  'link'            => 'required|url',
                  'start_date'      => 'required',
                  'end_date'        => 'required|after:start_date',
                  'image'           => 'array|min:1|max:1',
                ];
        }
    }

    public function messages()
    {

        $v = [
          "name.required"        => __('dashboard.ads.validation.name.required'),
          "link.required"        => __('dashboard.ads.validation.link.required'),
          "link.url"        => __('dashboard.ads.validation.link.url'),
          "start_date.required"        => __('dashboard.ads.validation.start_date.required'),
          "end_date.required"        => __('dashboard.ads.validation.end_date.required'),
          "end_date.after"        => __('dashboard.ads.validation.end_date.after'),
          "image.required"       => __('dashboard.ads.validation.image.required'),
          "image.max"            => __('dashboard.ads.validation.image.max'),
        ];

        foreach ($this->get('name') as $key => $value){
          $v["name.".$key.".required"] = __('dashboard.ads.validation.name.required').' - '.$key.'';
        }

        return $v;
    }
}
