<?php

namespace App\Modules\Assessments\Repository;

use App\Modules\Assessments\Models\Assessment;
use App\Modules\Questions\Models\Question;
use DB;

class AssessmentRepository
{
    function __construct(Assessment $assessment, Question $question)
    {
        $this->assessment = $assessment;
        $this->question = $question;
    }

    /*
    * Get All Objects
    */
    public function getAll($order = 'id', $sort = 'desc')
    {
        $assessments = $this->assessment->orderBy($order, $sort)->get();
        return $assessments;
    }

    /*
    * Get All Objects
    */
    public function getAllActive($order = 'id', $sort = 'desc')
    {
        $assessments = $this->assessment->where('status',1)->orderBy($order, $sort)->get();
        return $assessments;
    }

   /*
    * Find Object By ID
    */
    public function findById($id)
    {
        $assessment = $this->assessment->find($id);
        return $assessment;
    }

    /*
    * Create New Object & Insert to DB
    */
    public function create($request)
    {
        DB::beginTransaction();

        try {

            $assessment = $this->assessment->create([
              'doctor_id'    => $request->doctor_id,
              'status'       => $request->status ? 1 : 0,
              'price'        => $request->price,
              'image'        => $request['image'][0] ? get_path($request['image'][0]) : 'uploads/default.png',
            ]);

            $this->translateTable($assessment, $request);

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

            $assessment = $this->findById($id);

            $assessment->update([
              'doctor_id'    => $request->doctor_id,
              'status'       => $request->status ? 1 : 0,
              'price'        => $request->price,
              'image'        => $request['image'][0] ? get_path($request['image'][0]) : $assessment->image,
            ]);

            $this->translateTable($assessment, $request);

            //update questions
            $this->updateQuestions($assessment, $request);

            //upadte answers
            $this->updateAnswers($request);

            //upadte result ranges
            $this->updateResultRanges($request);

            //insert result ranges
            $this->insertResultRanges($assessment, $request);
            

            DB::commit();
            return true;

        }catch(\Exception $e){
            DB::rollback();
            throw $e;
        }
    }

    /**
     * update assessment questions
     * @param   $assessment 
     * @param  $request    
     * @return mixed
     */
    protected function updateQuestions($assessment, $request)
    {
        $question_id = $request->question_id;

        if (! is_null($question_id)) {
            for ($i = 0; $i < count($question_id); $i++) {

                $question_status = "question_status_{$question_id[$i]}";

                $assessment->questions()->where([
                    'id' => $question_id[$i],
                ])->update([
                    'status' => $request->{$question_status} ? 1 : 0
                ]);

                foreach (config('setting.locales') as $code) {
                    DB::table('question_translations')
                        ->where([
                            'question_id' => $question_id[$i],
                            'locale' => $code
                        ])->update([
                            'question' => $request->question[$code][$i]
                        ]);
                }
            }
        }
    }

    /**
     * update asssessment question answers
     * @param  $request 
     * @return mixed          
     */
    protected function updateAnswers($request)
    {
        $answer_id = $request->answer_id;

        if (! is_null($answer_id)) {
            for ($j = 0; $j < count($answer_id); $j++) {

                $answer_value = "answer_value_{$answer_id[$j]}";

                DB::table('answers')
                    ->where('id', '=', $answer_id[$j])
                    ->update(['value' => $request->{$answer_value}]);

                foreach (config('setting.locales') as $code) {
                    DB::table('answer_translations')
                        ->where([
                            'answer_id' => $answer_id[$j],
                            'locale' => $code
                        ])->update([
                            'answer' => $request->answer[$code][$j]
                        ]);
                }
            }
        }
    }

    /**
     * update assessment result ranges
     * @param  $request 
     * @return mixed
     */
    protected function updateResultRanges($request)
    {
        if (isset($request->result_range_id)) {
            $result_range_id = $request->result_range_id;

            for ($j = 0; $j < count($result_range_id); $j++) {

                $score_from = "score_from_{$result_range_id[$j]}";
                $score_to = "score_to_{$result_range_id[$j]}";

                DB::table('result_ranges')
                    ->where('id', '=', $result_range_id[$j])
                    ->update([
                        'score_from' => $request->{$score_from},
                        'score_to' => $request->{$score_to},
                    ]);

                foreach (config('setting.locales') as $code) {
                    DB::table('result_range_translations')
                        ->where([
                            'result_range_id' => $result_range_id[$j],
                            'locale' => $code
                        ])->update([
                            'rank' => $request->rank[$code][$j],
                            'message' => $request->message[$code][$j]
                        ]);
                }
            }
        }
    }

    /**
     * insert new assessment result ranges
     * @param  $assessment 
     * @param  $request    
     * @return mixed             
     */
    protected function insertResultRanges($assessment, $request)
    {
      $score_from = $request->score_from;
      $score_to   = $request->score_to;

      if(! is_null($score_from)):
          for ($h=0; $h < count(array_filter($request->score_from)) ; $h++) { 
             $result_range = $assessment->result_ranges()->updateOrCreate([
                                    'assessment_id' => $assessment->id,
                                    'score_from' => $score_from[$h],
                                    'score_to'   => $score_to[$h],
                                ],
                                [
                                      'score_from' => $score_from[$h],
                                      'score_to'   => $score_to[$h],
                                 ]);

            foreach (config('setting.locales') as $code) {
                DB::table('result_range_translations')
                    ->updateOrInsert([
                        'result_range_id' => $result_range->id,
                        'locale' => $code,
                    ],
                    [
                        'rank' => $request->rank_new[$code][$h],
                        'message' => $request->message_new[$code][$h],
                    ]);
            }
          }
      endif;
    }

    /*
    * Translate all fields with multi languages
    */
    public function translateTable($model,$request)
    {
        foreach ($request['name'] as $locale => $value) {
          $model->translateOrNew($locale)->name            = $value;
          $model->translateOrNew($locale)->description         = $request['description'][$locale];
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
        return $assessments = $this->assessment->destroy($request['ids']);
    }

    /*
    * Generate Datatable
    */
    public function QueryTable($request)
    {
        $query = $this->assessment
                ->select('*',DB::raw('DATE_FORMAT(created_at, "%Y-%m-%d") as createdAt'))
                ->where(function($query) use($request) {
                    $query
                    ->where('id'               , 'like' , '%'. $request->input('search.value') .'%')
                    ->orWhere('name'           , 'like' , '%'. $request->input('search.value') .'%');
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
