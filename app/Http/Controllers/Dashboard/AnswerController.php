<?php

namespace App\Http\Controllers\Dashboard;

use App\Modules\Answers\Repository\AnswerRepository as Answer;
use App\Modules\Answers\Requests\AnswerRequest;
use Illuminate\Http\Request;
use DataTable;

class AnswerController extends DashboardController
{
    public function __construct(Answer $answer)
    {
        $this->answer = $answer;
    }

    public function index()
    {
        return view('dashboard.answers.home');
    }

    public function dataTable(Request $request)
    {
        return DataTable::GenerateTable($request, $this->answer->QueryTable($request, $request->get('question_id')));
    }

    public function create($question_id)
    {
        return view('dashboard.answers.create', compact('question_id'));
    }

    public function store(AnswerRequest $request)
    {
        $create = $this->answer->create($request);

        if ($create) {
            return Response()->json([true , __('dashboard.general.create_success_alert')]);
        }

        return Response()->json([false  , __('dashboard.general.ops_alert')]);
    }

    public function show($id)
    {
        //
    }

    public function edit($id)
    {
        $answer  = $this->answer->findById($id);

        if (!$answer)
            return abort(404);

        return view('dashboard.answers.edit' , compact('answer'));
    }

    public function update(AnswerRequest $request, $id)
    {
        if ($request->ajax()){

            $update = $this->answer->update($request , $id);

            if($update){
                return Response()->json([true , __('dashboard.general.update_success_alert')]);
            }

            return Response()->json([false  , __('dashboard.general.ops_alert')]);
        }
    }

    public function destroy($id)
    {
        try {
            $repose = $this->answer->delete($id);

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
            $repose = $this->answer->deleteAll($request);

            if ($repose) {
                return Response()->json([true, __('dashboard.general.delete_success_alert')]);
            }

            return Response()->json([false  , __('dashboard.general.ops_alert')]);
        } catch (\PDOException $e) {
            return Response()->json([false, $e->errorInfo[2]]);
        }
    }
}
