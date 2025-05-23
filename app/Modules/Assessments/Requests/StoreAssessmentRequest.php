<?php

namespace App\Modules\Assessments\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreAssessmentRequest extends FormRequest
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
                  'assessment_id'          => 'required|exists:assessments,id',
                  'questions'              => 'required',
                  'questions.*.id'         => 'required|exists:questions,id',
                  'questions.*.answer_id'  => 'required|exists:answers,id',
                  'questions.*.value'      => 'required',
                ];
        }
    }

    public function messages()
    {

        $v = [
          "assessment_id.required"        => __('api.assessments.validation.assessment_id.required'),
        ];

        foreach ($this->get('questions') as $key => $value){
          $v["questions.".$key.".id.required"] = __('api.assessments.validation.questions.id.required');
          $v["questions.".$key.".id.exists"] = __('api.assessments.validation.questions.id.exists');
          $v["questions.".$key.".answer_id.required"] = __('api.assessments.validation.questions.answer_id.required');
          $v["questions.".$key.".answer_id.exists"] = __('api.assessments.validation.questions.answer_id.exists');
          $v["questions.".$key.".value.required"] = __('api.assessments.validation.questions.value.required');
        }

        return $v;
    }
}
