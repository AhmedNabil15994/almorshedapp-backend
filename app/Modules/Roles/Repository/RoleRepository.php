<?php

namespace App\Modules\Roles\Repository;

use App\Modules\Roles\Models\Role;
use DB;

class RoleRepository
{
    function __construct(Role $role)
    {
        $this->role = $role;
    }

    /*
    * Get All Objects
    */
    public function getAll($order = 'id', $sort = 'desc')
    {
        $roles = $this->role->orderBy($order, $sort)->get();
        return $roles;
    }

    /*
    * Find Object By ID
    */
    public function findById($id)
    {
        $role = $this->role->find($id);
        return $role;
    }

    /*
    * Create New Object & Insert to DB
    */
    public function create($request)
    {
        DB::beginTransaction();

        try {

            $role = $this->role->create([
              'name'  => $request->input('name'),
            ]);

            if (! empty($request['permission'])) {
                foreach ($request['permission'] as $key => $value) {
                    $role->attachPermission($value);
                }
            }

            $this->translateTable($role,$request);

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

            $role = $this->findById($id);

            $role->update([
              'name'  => $request->input('name'),
            ]);

            DB::table('permission_role')->where('role_id',$id)->delete();
            foreach ($request['permission'] as $key => $value) {
                $role->attachPermission($value);
            }

            $this->translateTable($role,$request);

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
        return $roles = $this->role->destroy($request['ids']);
    }

    /*
    * Generate Datatable
    */
    public function QueryTable($request)
    {
        $query = $this->role
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
