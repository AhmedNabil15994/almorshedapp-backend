<?php

namespace App\Modules\Answers\Repository;

use App\Modules\Answers\Models\Answer;
use DB;

class AnswerRepository
{
    function __construct(Answer $answer)
    {
        $this->answer = $answer;
    }

    /*
    * Get All Objects
    */
    public function getAll($order = 'id', $sort = 'desc')
    {
        $answers = $this->answer->orderBy($order, $sort)->get();
        return $answers;
    }

    /*
    * Get All Objects
    */
    public function getAllActive($order = 'id', $sort = 'desc')
    {
        $answers = $this->answer->where('status',1)->orderBy($order, $sort)->get();
        return $answers;
    }

   /*
    * Find Object By ID
    */
    public function findById($id)
    {
        $answer = $this->answer->find($id);
        return $answer;
    }

    /*
    * Create New Object & Insert to DB
    */
    public function create($request)
    {
        DB::beginTransaction();

        try {

            $answer = $this->answer->create([
              'question_id'    => $request->question_id,
              'status'         => $request->status ? 1 : 0,
              'value'          => $request->value,    
            ]);

            $this->translateTable($answer, $request);

            $value = $request->value;

            DB::commit();
            return true;

        }catch(\Exception $e){
            DB::rollback();
            throw $e;
        }
    }

    /*
    * Find Object By ID & Update to DB
    */
    public function update($request,$id)
    {
        DB::beginTransaction();

        try {

            $answer = $this->findById($id);

            $answer->update([
              'question_id'    => $request->question_id,
              'status'         => $request->status ? 1 : 0,
              'value'          => $request->value,
            ]);

            $this->translateTable($answer, $request);

            DB::commit();
            return true;

        }catch(\Exception $e){
            DB::rollback();
            throw $e;
        }
    }

    /*
    * Translate all fields with multi languages
    */
    public function translateTable($model,$request)
    {
        foreach ($request['answer'] as $locale => $value) {
          $model->translateOrNew($locale)->answer            = $value;
        }

        $model->save();
    }

    /*
    * Find Object By ID & Delete it from DB
    */
    public function delete($id)
    {
        DB::beginTransaction();

        try {

            $model = $this->findById($id);

            $model->delete();

            DB::commit();
            return true;

        }catch(\Exception $e){
            DB::rollback();
            throw $e;
        }
    }

    /*
    * Find all Objects By IDs & Delete it from DB
    */
    public function deleteAll($request)
    {
        return $answers = $this->answer->destroy($request['ids']);
    }

    /*
    * Generate Datatable
    */
    public function QueryTable($request, $question_id)
    {
        $query = $this->answer
                ->select('*',DB::raw('DATE_FORMAT(created_at, "%Y-%m-%d") as createdAt'))
                ->where('question_id', '=', $question_id)
                ->where(function($query) use($request) {
                    $query
                    ->where('id'               , 'like' , '%'. $request->input('search.value') .'%')
                    ->orWhere('answer'           , 'like' , '%'. $request->input('search.value') .'%');
                });

        $query = self::filterDataTable($query,$request);

        return $query;
    }

    /*
    * Filteration for Datatable
    */
    public static function filterDataTable($query,$request)
    {
        if (isset($request['req']['from']) && $request['req']['from'] != '')
            $query->whereDate('created_at'  , '>=' , $request['req']['from']);

        if (isset($request['req']['to']) && $request['req']['to'] != '')
            $query->whereDate('created_at'  , '<=' , $request['req']['to']);

        return $query;
    }
}
