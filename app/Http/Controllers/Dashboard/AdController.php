<?php

namespace App\Http\Controllers\Dashboard;

use App\Modules\Ads\Repository\AdRepository as Ad;
use App\Modules\Ads\Requests\AdRequest;
use Illuminate\Http\Request;
use DataTable;

class AdController extends DashboardController
{
    public function __construct(Ad $ad)
    {
        $this->ad = $ad;
    }

    public function index()
    {
        return view('dashboard.ads.home');
    }

    public function dataTable(Request $request)
    {
        return DataTable::GenerateTable($request, $this->ad->QueryTable($request));
    }

    public function create()
    {
        return view('dashboard.ads.create');
    }

    public function store(AdRequest $request)
    {
        $create = $this->ad->create($request);

        if ($create) {
            return Response()->json([true , __('dashboard.general.create_success_alert')]);
        }

        return Response()->json([false  , __('dashboard.general.ops_alert')]);
    }

    public function show($id)
    {
    }

    public function edit($id)
    {
        $ad  = $this->ad->findById($id);

        if (!$ad)
            return abort(404);

        return view('dashboard.ads.edit' , compact('ad'));
    }

    public function update(AdRequest $request, $id)
    {
        if ($request->ajax()){

            $update = $this->ad->update($request , $id);

            if($update){
                return Response()->json([true , __('dashboard.general.update_success_alert')]);
            }

            return Response()->json([false  , __('dashboard.general.ops_alert')]);
        }
    }

    public function destroy($id)
    {
        try {
            $repose = $this->ad->delete($id);

            if ($repose) {
                return Response()->json([true, __('dashboard.general.delete_success_alert')]);
            }
            return Response()->json([false  , __('dashboard.general.ops_alert')]);
        } catch (\PDOException $e) {
            return Response()->json([false, $e->errorInfo[2]]);
        }
    }

    public function deletes(Request $request)
    {
        try {
            $repose = $this->ad->deleteAll($request);

            if ($repose) {
                return Response()->json([true, __('dashboard.general.delete_success_alert')]);
            }

            return Response()->json([false  , __('dashboard.general.ops_alert')]);
        } catch (\PDOException $e) {
            return Response()->json([false, $e->errorInfo[2]]);
        }
    }
}
