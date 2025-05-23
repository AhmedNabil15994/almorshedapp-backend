<?php

namespace App\Modules\Articles\Repository;

use App\Modules\Articles\Models\Article;
use DB;

class ArticleRepository
{
    function __construct(Article $article)
    {
        $this->article = $article;
    }

    /*
    * Get All Objects
    */
    public function getAll($order = 'id', $sort = 'desc')
    {
        $articles = $this->article->orderBy($order, $sort)->get();
        return $articles;
    }

    /*
    * Get All Objects
    */
    public function getAllActive($order = 'id', $sort = 'desc')
    {
        $articles = $this->article->where('status',1)->orderBy($order, $sort)->get();
        return $articles;
    }

   /*
    * Find Object By ID
    */
    public function findById($id)
    {
        $article = $this->article->find($id);
        return $article;
    }

    /*
    * Create New Object & Insert to DB
    */
    public function create($request)
    {
        DB::beginTransaction();

        try {

            $article = $this->article->create([
              'status'       => $request->status ? 1 : 0,
              'image'        => $request['image'][0] ? get_path($request['image'][0]) : 'uploads/default.png',
            ]);

            $this->translateTable($article,$request);

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

            $article = $this->findById($id);

            $article->update([
              'status'       => $request->status ? 1 : 0,
              'image'        => $request['image'][0] ? get_path($request['image'][0]) : $article->image,
            ]);

            $this->translateTable($article,$request);

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
          $model->translateOrNew($locale)->name            = $value;
          $model->translateOrNew($locale)->content  = $request['content'][$locale];
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
        return $articles = $this->article->destroy($request['ids']);
    }

    /*
    * Generate Datatable
    */
    public function QueryTable($request)
    {
        $query = $this->article
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
