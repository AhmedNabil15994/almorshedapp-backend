<?php

namespace App\Modules\AvailabilityExceptions\Repository;

use App\Modules\AvailabilityExceptions\Models\AvailabilityException;
use DB;

class AvailabilityExceptionRepository
{
    function __construct(AvailabilityException $availability)
    {
        $this->availability = $availability;
    }

    /*
    * Get All Objects
    */
    public function getAll($order = 'id', $sort = 'desc')
    {
        $availabilities = $this->availability->orderBy($order, $sort)->get();
        return $availabilities;
    }

    /*
    * Get All Objects
    */
    /*public function getAllActive($order = 'id', $sort = 'desc')
    {
        $availabilities = $this->availability->where('status',1)->orderBy($order, $sort)->get();
        return $availabilities;
    }*/

   /*
    * Find Object By ID
    */
    public function findById($id)
    {
        $availability = $this->availability->find($id);
        return $availability;
    }

    /*
    * Create New Object & Insert to DB
    */
    public function create($request)
    {
        DB::beginTransaction();

        try {

            $availability = $this->availability->create([
              'doctor_id'         => $request->doctor_id,
              //'status'            => $request->status ? 1 : 0,
              'off_from'          => $request->off_from,
              'off_to'            => $request->off_to, 
              'off_date'          => $request->off_date,
            ]);

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

            $availability = $this->findById($id);

            $availability->update([
              'doctor_id'         => $request->doctor_id,
              'status'            => $request->status ? 1 : 0,
              'off_from'          => $request->off_from,
              'off_to'            => $request->off_to,  
              'off_date'          => $request->off_date,
            ]);

            DB::commit();
            return true;

        }catch(\Exception $e){
            DB::rollback();
            throw $e;
        }
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
        return $availabilities = $this->availability->destroy($request['ids']);
    }

    /*
    * Generate Datatable
    */
    public function QueryTable($request, $doctor_id)
    {
        $query = $this->availability
                ->select('*',DB::raw('DATE_FORMAT(created_at, "%Y-%m-%d") as createdAt'))
                ->where('doctor_id', '=', $doctor_id)
                ->where(function($query) use($request) {
                    $query
                    ->where('id'               , 'like' , '%'. $request->input('search.value') .'%');
                    //->orWhere('answer'           , 'like' , '%'. $request->input('search.value') .'%');
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
