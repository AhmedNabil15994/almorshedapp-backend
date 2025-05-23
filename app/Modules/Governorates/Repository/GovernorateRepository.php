<?php

namespace App\Modules\Governorates\Repository;

use App\Modules\Governorates\Models\Governorate;
use DB;

class GovernorateRepository
{
    function __construct(Governorate $governorate)
    {
        $this->governorate = $governorate;
    }

    /*
    * Get All Objects
    */
    public function getAll($order = 'id', $sort = 'desc')
    {
        $governorates = $this->governorate->orderBy($order, $sort)->get();
        return $governorates;
    }

    /*
    * Find Object By ID
    */
    public function findById($id)
    {
        $governorate = $this->governorate->find($id);
        return $governorate;
    }

    /*
    * Create New Object & Insert to DB
    */
    public function create($request)
    {
        DB::beginTransaction();

        try {

            $governorate = $this->governorate->create([
              'name'  => $request->input('name'),
            ]);

            foreach ($request['permission'] as $key => $value) {
                $governorate->attachPermission($value);
            }

            $this->translateTable($governorate,$request);

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

            $governorate = $this->findById($id);

            $governorate->update([
              'name'  => $request->input('name'),
            ]);

            DB::table('permission_governorate')->where('governorate_id',$id)->delete();
            foreach ($request['permission'] as $key => $value) {
                $governorate->attachPermission($value);
            }

            $this->translateTable($governorate,$request);

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
        return $governorates = $this->governorate->destroy($request['ids']);
    }

    /*
    * Generate Datatable
    */
    public function QueryTable($request)
    {
        $query = $this->governorate
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
