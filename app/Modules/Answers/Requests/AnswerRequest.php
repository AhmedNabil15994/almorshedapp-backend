<?php

namespace App\Modules\Answers\Requests;

use Illuminate\Foundation\Http\FormRequest;

class AnswerRequest extends FormRequest
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
                  'answer.*'          => 'required',
                  'question_id'       => 'required',
                  'value'             => 'required',
                ];

            //handle updates
            case 'put':
            case 'PUT':
                return [
                  'answer.*'          => 'required',
                  'question_id'       => 'required',
                  'value'             => 'required',
                ];
        }
    }

    public function messages()
    {

        $v = [
          "answer.required"        => __('dashboard.answers.validation.answer.required'),
          "question_id.required"   => __('dashboard.answers.validation.question_id.required'),
          "value.required"   => __('dashboard.answers.validation.value.required'),
        ];

        foreach ($this->get('answer') as $key => $value){
          $v["answer.".$key.".required"] = __('dashboard.answers.validation.answer.required').' - '.$key.'';
        }

        return $v;
    }
}
