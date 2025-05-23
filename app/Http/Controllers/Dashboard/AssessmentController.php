<?php

namespace App\Http\Controllers\Dashboard;

use App\Modules\Doctors\Repository\DoctorRepository as Doctor;
use App\Modules\Assessments\Repository\AssessmentRepository as Assessment;
use App\Modules\Questions\Repository\QuestionRepository as Question;
use App\Modules\Assessments\Requests\AssessmentRequest;
use Illuminate\Http\Request;
use DataTable;

class AssessmentController extends DashboardController
{
    public function __construct(Assessment $assessment, Doctor $doctor, Question $question)
    {
        $this->assessment = $assessment;
        $this->doctor = $doctor;
    }

    public function index()
    {
        return view('dashboard.assessments.home');
    }

    public function dataTable(Request $request)
    {
        return DataTable::GenerateTable($request, $this->assessment->QueryTable($request));
    }

    public function create()
    {
        $doctors = $this->doctor->getAll('id', 'asc'); 

        return view('dashboard.assessments.create', compact('doctors'));
    }

    public function store(AssessmentRequest $request)
    {
        $create = $this->assessment->create($request);

        if ($create) {
            return Response()->json([true , __('dashboard.general.create_success_alert')]);
        }

        return Response()->json([false  , __('dashboard.general.ops_alert')]);
    }

    //get questions by assessment
    public function show($id)
    {
        $assessment_id = $id;

        return view('dashboard.questions.home', compact('assessment_id'));
    }

    public function edit($id)
    {
        $doctors = $this->doctor->getAll('id', 'asc'); 

        $assessment  = $this->assessment->findById($id);

        //dd($assessment->questions);

        if (!$assessment)
            return abort(404);

        return view('dashboard.assessments.edit' , compact('assessment', 'doctors'));
    }

    public function update(AssessmentRequest $request, $id)
    {
        if ($request->ajax()){

            $update = $this->assessment->update($request , $id);

            if($update){
                return Response()->json([true , __('dashboard.general.update_success_alert')]);
            }

            return Response()->json([false  , __('dashboard.general.ops_alert')]);
        }
    }

    public function destroy($id)
    {
        try {
            $repose = $this->assessment->delete($id);

            if ($repose) {
                return Response()->json([true, __('dashboard.general.delete_success_alert')]);
            }
            return Response()->json([false  , __('dashboard.general.ops_alert')]);
        } catch (\PDOException $e) {
            return Response()->json([false, $e->errorInfo[2]]);
        }
    }

    public function deletes(Request $request)
    {
        try {
            $repose = $this->assessment->deleteAll($request);

            if ($repose) {
                return Response()->json([true, __('dashboard.general.delete_success_alert')]);
            }

            return Response()->json([false  , __('dashboard.general.ops_alert')]);
        } catch (\PDOException $e) {
            return Response()->json([false, $e->errorInfo[2]]);
        }
    }
}
