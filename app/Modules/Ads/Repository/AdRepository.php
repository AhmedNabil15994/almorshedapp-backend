<?php

namespace App\Modules\Ads\Repository;

use Carbon\Carbon;
use App\Modules\Ads\Models\Ad;
use DB;

class AdRepository
{
    function __construct(Ad $ad)
    {
        $this->ad = $ad;
    }

    /*
    * Get All Objects
    */
    public function getAll($order = 'id', $sort = 'desc')
    {
        $ads = $this->ad->orderBy($order, $sort)->get();
        return $ads;
    }

    /*
    * Get All Objects
    */
    public function getAllActive($order = 'id', $sort = 'desc')
    {
        $current_date = Carbon::now();

        $ads = $this->ad
                    ->where([
                        ['start_date', '<=', $current_date],
                        ['end_date', '>=', $current_date],
                        ['status', '=', 1]
                    ])
                    ->orderBy($order, $sort)
                    ->get();
        return $ads;
    }

   /*
    * Find Object By ID
    */
    public function findById($id)
    {
        $ad = $this->ad->find($id);
        return $ad;
    }

    /*
    * Create New Object & Insert to DB
    */
    public function create($request)
    {
        DB::beginTransaction();

        try {

            $ad = $this->ad->create([
              'link'         => $request->link,
              'start_date'   => $request->start_date,
              'end_date'     => $request->end_date,
              'status'       => $request->status ? 1 : 0,
              'image'        => $request['image'][0] ? get_path($request['image'][0]) : 'uploads/default.png',
            ]);

            $this->translateTable($ad, $request);

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

            $ad = $this->findById($id);

            $ad->update([
              'link'         => $request->link,
              'start_date'   => $request->start_date,
              'end_date'     => $request->end_date,
              'status'       => $request->status ? 1 : 0,
              'image'        => $request['image'][0] ? get_path($request['image'][0]) : $ad->image,
            ]);

            $this->translateTable($ad, $request);

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
        return $ads = $this->ad->destroy($request['ids']);
    }

    /*
    * Generate Datatable
    */
    public function QueryTable($request)
    {
        $query = $this->ad
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
