<?php

namespace App\Http\Controllers\Api\V1\UserApp;

use App\Modules\Assessments\Models\Assessment;
use App\Http\Controllers\Api\ApiController;
use Illuminate\Http\Request;

class UserAssessmentController extends ApiController
{

    /**
     * Create a new controller instance.
     */
    public function __construct()
    {
        //
    }

    public function store(Request $request)
    {
        $assessment = Assessment::where('id', $request->assessment_id)->first();

        //calculate assessment score
        $score = 0;

        foreach ($assessment->questions as $question) {
            $answer = "answer_{$question->id}";
            $score += $request->{$answer};
        }

        //update assessment order 
        auth()->user()->assessmentOrders()
              ->where('assessment_id', $request->assessment_id)
              ->update([
                'status' =>  1,
                'score'  => $score
            ]);
        
        //display result for assessment
        $result = $assessment->result_ranges()
                            ->whereRaw('? between score_from and score_to', [$score])
                            ->first();

        return view('api.assessments.assessment-result', compact('result'));
    }

}
