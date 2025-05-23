<?php

namespace App\Modules\Assessments\Requests;

use Illuminate\Foundation\Http\FormRequest;

class AssessmentRequest extends FormRequest
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
                  'description.*'   => 'required',
                  'price'           => 'required',
                  'image'           => 'required|array|min:1|max:1',
                ];

            //handle updates
            case 'put':
            case 'PUT':
                return [
                  'name.*'          => 'required',
                  'description.*'   => 'required',
                  'price'           => 'required',
                  'image'           => 'array|min:1|max:1',
                ];
        }
    }

    public function messages()
    {

        $v = [
          "name.required"        => __('dashboard.assessments.validation.name.required'),
          "doctor_id.required"   => __('dashboard.assessments.validation.doctor_id.required'),
          "description.required" => __('dashboard.assessments.validation.description.required'),
          "price.required"       => __('dashboard.assessments.validation.price.required'),
          "image.required"       => __('dashboard.assessments.validation.image.required'),
          "image.max"            => __('dashboard.assessments.validation.image.max'),
        ];

        foreach ($this->get('name') as $key => $value){
          $v["name.".$key.".required"] = __('dashboard.assessments.validation.name.required').' - '.$key.'';
        }

        foreach ($this->get('description') as $key => $value){
          $v["description.".$key.".required"] = __('dashboard.assessments.validation.description.required').' - '.$key.'';
        }

        return $v;
    }
}
