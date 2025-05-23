<?php

namespace App\Modules\Questions\Requests;

use Illuminate\Foundation\Http\FormRequest;

class QuestionRequest extends FormRequest
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
                  'question.*'          => 'required',
                  'answer.*.*'            => 'required',
                  'assessment_id'       => 'required',
                ];

            //handle updates
            case 'put':
            case 'PUT':
                return [
                  'question.*'          => 'required',
                  'assessment_id'       => 'required',
                ];
        }
    }

    public function messages()
    {

        $v = [
          "question.required"        => __('dashboard.questions.validation.question.required'),
          "answer.required"        => __('dashboard.answers.validation.answer.required'),
          "assessment_id.required"   => __('dashboard.questions.validation.assessment_id.required'),
        ];

        foreach ($this->get('question') as $key => $value){
          $v["question.".$key.".required"] = __('dashboard.questions.validation.question.required').' - '.$key.'';
        }

        $answer = $this->get('answer');

        if (! is_null($answer)) {
          foreach ($answer as $key => $value){
            for ($i=0; $i < count($answer) ; $i++) { 
              $v["answer.{$key}.{$i}.required"] = __('dashboard.answers.validation.answer.required').' - '.$key.'';
            }
          }
      }

        return $v;
    }
}
