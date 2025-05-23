<?php

namespace App\Http\Controllers\Dashboard;

use App\Modules\Questions\Repository\QuestionRepository as Question;
use App\Modules\Questions\Requests\QuestionRequest;
use Illuminate\Http\Request;
use DataTable;

class QuestionController extends DashboardController
{
    public function __construct(Question $question)
    {
        $this->question = $question;
    }

    public function index()
    {
        return view('dashboard.questions.home');
    }

    public function dataTable(Request $request)
    {
        return DataTable::GenerateTable($request, $this->question->QueryTable($request, $request->get('assessment_id')));
    }

    public function create($assessment_id)
    {
        return view('dashboard.questions.create', compact('assessment_id'));
    }

    public function store(QuestionRequest $request)
    {
        $create = $this->question->create($request);

        if ($create) {
            return Response()->json([true , __('dashboard.general.create_success_alert')]);
        }

        return Response()->json([false  , __('dashboard.general.ops_alert')]);
    }

    public function show($id)
    {
        $question_id = $id;

        return view('dashboard.answers.home', compact('question_id'));
    }

    public function edit($id)
    {
        $question  = $this->question->findById($id);

        $answers = $question->answers;

        //dd(count($answers));

        if (!$question)
            return abort(404);

        return view('dashboard.questions.edit' , compact('question', 'answers'));
    }

    public function update(QuestionRequest $request, $id)
    {
        if ($request->ajax()){

            $update = $this->question->update($request , $id);

            if($update){
                return Response()->json([true , __('dashboard.general.update_success_alert')]);
            }

            return Response()->json([false  , __('dashboard.general.ops_alert')]);
        }
    }

    public function destroy($id)
    {
        try {
            $repose = $this->question->delete($id);

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
            $repose = $this->question->deleteAll($request);

            if ($repose) {
                return Response()->json([true, __('dashboard.general.delete_success_alert')]);
            }

            return Response()->json([false  , __('dashboard.general.ops_alert')]);
        } catch (\PDOException $e) {
            return Response()->json([false, $e->errorInfo[2]]);
        }
    }
}
