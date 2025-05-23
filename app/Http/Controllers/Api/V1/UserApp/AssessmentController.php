<?php

namespace App\Http\Controllers\Api\V1\UserApp;

use App\Modules\Assessments\Repository\AssessmentRepository;
use App\Modules\Assessments\Resources\AssessmentResource;
use App\Modules\Assessments\Resources\ResultResource;
use App\Modules\Questions\Resources\QuestionResource;
use App\Modules\Assessments\Requests\StoreAssessmentRequest;
use App\Http\Controllers\Api\ApiController;
use Illuminate\Http\Request;

class AssessmentController extends ApiController
{
    protected $assessmentRepo;

    /**
     * Create a new controller instance.
     */
    public function __construct(AssessmentRepository $assessmentRepo)
    {
        $this->assessmentRepo = $assessmentRepo;
    }

    /**
     * get general assessments and this doctor assessments
     * @return JsonResponse
     */
    public function index()
    {
        $assessments = $this->assessmentRepo->getAllActive();

        return $this->sendResponse(AssessmentResource::collection($assessments));
    }

    /**
     * get assessment form with questions and answers
     * @return view
     */
    public function show($id)
    {
        $assessment = $this->assessmentRepo->findById($id);

        if(!$assessment)
            return $this->sendError(__('api.assessments.assessment_not_found'), [], 404);

        return $this->sendResponse(QuestionResource::collection($assessment->questions));
    }

    /**
     * Store assessment 
     * @param  Request $request 
     * @return mixed
     */
    public function store(StoreAssessmentRequest $request)
    {
        $score = 0;

        $assessment = $this->assessmentRepo->findById($request->assessment_id);

        if(!$assessment)
            return $this->sendError(__('api.assessments.assessment_not_found'), [], 404);

        foreach ($request->questions as $question) {
            $score += $question['value'];
        }

        $result = $assessment->result_ranges()
                            ->whereRaw('? between score_from and score_to', [$score])
                            ->first();

        return $this->sendResponse(new ResultResource($result));
    }

}
