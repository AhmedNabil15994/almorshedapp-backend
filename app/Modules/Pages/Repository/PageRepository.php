<?php

namespace App\Modules\Pages\Repository;

use App\Modules\Pages\Models\Page;
use DB;

class PageRepository
{
    function __construct(Page $page)
    {
        $this->page = $page;
    }

    /*
    * Get All Objects
    */
    public function getAll($order = 'id', $sort = 'desc')
    {
        $pages = $this->page->orderBy($order, $sort)->get();
        return $pages;
    }

    /*
    * Get All Objects
    */
    public function getAllActive($order = 'id', $sort = 'desc')
    {
        $pages = $this->page->where('status',1)->orderBy($order, $sort)->get();
        return $pages;
    }

    /*
    * Find Object By ID
    */
    public function findById($id)
    {
        $page = $this->page->find($id);
        return $page;
    }

    /*
    * Create New Object & Insert to DB
    */
    public function create($request)
    {
        DB::beginTransaction();

        try {

            $page = $this->page->create([
              'page_id'  => $request->page_id ? $request->page_id : null,
              'status'   => $request->status ? 1 : 0,
            ]);

            $this->translateTable($page,$request);

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

            $page = $this->findById($id);

            $page->update([
              'page_id'  => $request->page_id ? $request->page_id : null,
              'status'   => $request->status ? 1 : 0,
            ]);

            $this->translateTable($page,$request);

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
        foreach ($request['title'] as $locale => $value) {
          $model->translateOrNew($locale)->title           = $value;
          $model->translateOrNew($locale)->slug            = slugfy($value);
          $model->translateOrNew($locale)->description     = $request['description'][$locale];
          $model->translateOrNew($locale)->seo_description = $request['seo_description'][$locale];
          $model->translateOrNew($locale)->seo_keywords    = $request['seo_keywords'][$locale];
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
        return $pages = $this->page->destroy($request['ids']);
    }

    /*
    * Generate Datatable
    */
    public function QueryTable($request)
    {
        $query = $this->page
                ->select('*',DB::raw('DATE_FORMAT(created_at, "%Y-%m-%d") as createdAt'))
                ->where(function($query) use($request) {
                    $query
                    ->where('id'                , 'like' , '%'. $request->input('search.value') .'%')
                    ->orWhere('title'           , 'like' , '%'. $request->input('search.value') .'%')
                    ->orWhere('description'     , 'like' , '%'. $request->input('search.value') .'%');
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
