<?php

namespace App\Modules\Questions\Repository;

use App\Modules\Questions\Models\Question;
use DB;

class QuestionRepository
{
    function __construct(Question $question)
    {
        $this->question = $question;
    }

    /*
    * Get All Objects
    */
    public function getAll($order = 'id', $sort = 'desc')
    {
        $questions = $this->question->orderBy($order, $sort)->get();
        return $questions;
    }

    /*
    * Get All Objects
    */
    public function getAllActive($order = 'id', $sort = 'desc')
    {
        $questions = $this->question->where('status',1)->orderBy($order, $sort)->get();
        return $questions;
    }

   /*
    * Find Object By ID
    */
    public function findById($id)
    {
        $question = $this->question->find($id);
        return $question;
    }

    /*
    * Create New Object & Insert to DB
    */
    public function create($request)
    {
        DB::beginTransaction();

        try {

            $question = $this->question->create([
              'assessment_id'    => $request->assessment_id,
              'status'           => $request->status ? 1 : 0,
            ]);

            $this->translateTable($question, $request);

            $value = $request->value;

            for ($i = 0; $i < count($value); $i++) {
                $answer = $question->answers()->create([
                    'value' => $request->value[$i],
                    'status' => 1,
                ]);


                foreach (config('setting.locales') as $code) {
                    DB::table('answer_translations')->insert([
                        'answer' => $request->answer[$code][$i],
                        'locale' => $code,
                        'answer_id' => $answer->id
                    ]);
                }
            }

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

            $question = $this->findById($id);

            $question->update([
              'assessment_id'    => $request->assessment_id,
              'status'           => $request->status ? 1 : 0,
            ]);

            $this->translateTable($question, $request);

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
        foreach ($request['question'] as $locale => $value) {
          $model->translateOrNew($locale)->question            = $value;
        }

        $model->save();
    }

    public function translateAnswersTable($answer, $request)
    {
        //
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
        return $questions = $this->question->destroy($request['ids']);
    }

    /*
    * Generate Datatable
    */
    public function QueryTable($request, $assessment)
    {
        $query = $this->question
                ->select('*',DB::raw('DATE_FORMAT(created_at, "%Y-%m-%d") as createdAt'))
                ->where('assessment_id', '=', $assessment)
                ->where(function($query) use($request) {
                    $query
                    ->where('id'               , 'like' , '%'. $request->input('search.value') .'%')
                    ->orWhere('question'           , 'like' , '%'. $request->input('search.value') .'%');
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
