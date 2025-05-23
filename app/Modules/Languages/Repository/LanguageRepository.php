<?php

namespace App\Modules\Languages\Repository;

use App\Modules\Languages\Models\Language;
use DB;

class LanguageRepository
{
    function __construct(Language $language)
    {
        $this->language = $language;
    }

    /*
    * Get All Objects
    */
    public function getAll($order = 'id', $sort = 'desc')
    {
        $languages = $this->language->orderBy($order, $sort)->get();
        return $languages;
    }

    /*
    * Get All Objects
    */
    public function getAllActive($order = 'id', $sort = 'desc')
    {
        $languages = $this->language->where('status',1)->orderBy($order, $sort)->get();
        return $languages;
    }

   /*
    * Find Object By ID
    */
    public function findById($id)
    {
        $language = $this->language->find($id);
        return $language;
    }

    /*
    * Create New Object & Insert to DB
    */
    public function create($request)
    {
        DB::beginTransaction();

        try {

            $language = $this->language->create([
              'language'     => $request->language,
              'status'       => $request->status ? 1 : 0,
            ]);

            $this->translateTable($language, $request);

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

            $language = $this->findById($id);

            $language->update([
              'language'     => $request->language,
              'status'       => $request->status ? 1 : 0,
            ]);

            $this->translateTable($language, $request);

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
        foreach ($request['name'] as $locale => $value) {
          $model->translateOrNew($locale)->name = $value;
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
        return $ads = $this->language->destroy($request['ids']);
    }

    /*
    * Generate Datatable
    */
    public function QueryTable($request)
    {
        $query = $this->language
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
