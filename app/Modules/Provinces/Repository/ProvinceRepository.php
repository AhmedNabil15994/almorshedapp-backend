<?php

namespace App\Modules\Provinces\Repository;

use App\Modules\Provinces\Models\Province;
use DB;

class ProvinceRepository
{
    function __construct(Province $province)
    {
        $this->province = $province;
    }

    /*
    * Get All Objects
    */
    public function getAll($order = 'id', $sort = 'desc')
    {
        $provinces = $this->province->orderBy($order, $sort)->get();
        return $provinces;
    }

    /*
    * Find Object By ID
    */
    public function findById($id)
    {
        $province = $this->province->find($id);
        return $province;
    }

    /*
    * Create New Object & Insert to DB
    */
    public function create($request)
    {
        DB::beginTransaction();

        try {

            $province = $this->province->create([
              'name'  => $request->input('name'),
            ]);

            foreach ($request['permission'] as $key => $value) {
                $province->attachPermission($value);
            }

            $this->translateTable($province,$request);

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

            $province = $this->findById($id);

            $province->update([
              'name'  => $request->input('name'),
            ]);

            DB::table('permission_province')->where('province_id',$id)->delete();
            foreach ($request['permission'] as $key => $value) {
                $province->attachPermission($value);
            }

            $this->translateTable($province,$request);

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
        foreach ($request['description'] as $locale => $value) {
          $model->translateOrNew($locale)->description = $value;
          $model->translateOrNew($locale)->display_name = $request['display_name'][$locale];
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
        return $provinces = $this->province->destroy($request['ids']);
    }

    /*
    * Generate Datatable
    */
    public function QueryTable($request)
    {
        $query = $this->province
                ->with('perms')
                ->select('*',DB::raw('DATE_FORMAT(created_at, "%Y-%m-%d") as createdAt'))
                ->where(function($query) use($request) {
                    $query
                    ->where('id'                , 'like' , '%'. $request->input('search.value') .'%')
                    ->orWhere('name'            , 'like' , '%'. $request->input('search.value') .'%')
                    ->orWhere('display_name'    , 'like' , '%'. $request->input('search.value') .'%')
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
