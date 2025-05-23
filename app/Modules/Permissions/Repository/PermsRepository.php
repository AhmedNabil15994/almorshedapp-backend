<?php

namespace App\Modules\Permissions\Repository;

use App\Modules\Permissions\Models\Permission;
use DB;

class PermsRepository
{
    function __construct(Permission $permission)
    {
        $this->permission = $permission;
    }

    /*
    * Get All Objects
    */
    public function getAll($order = 'id', $sort = 'desc')
    {
        $permissions = $this->permission->orderBy($order, $sort)->get();
        return $permissions;
    }

    /*
    * Find Object By ID
    */
    public function findById($id)
    {
        $permission = $this->permission->find($id);
        return $permission;
    }

    /*
    * Create New Object & Insert to DB
    */
    public function create($request)
    {
        DB::beginTransaction();

        try {

            $perm = $this->permission->create([
              'name'                => $request->input('name'),
              'display_name'        => $request->input('display_name'),
            ]);

            $this->translateTable($perm,$request);

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

            $perm = $this->findById($id);

            $perm->update([
              'name'                => $request->input('name'),
              'display_name'        => $request->input('display_name'),
            ]);

            $this->translateTable($perm,$request);

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
        return $permissions = $this->permission->destroy($request['ids']);
    }

    /*
    * Generate Datatable
    */
    public function QueryTable($request)
    {
        $query = $this->permission
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
