<?php

namespace App\Http\Controllers\Dashboard;

use App\Modules\Services\Repository\ServiceRepository as Service;
use App\Modules\Services\Requests\ServiceRequest;
use Illuminate\Http\Request;
use DataTable;

class ServiceController extends DashboardController
{
    public function __construct(Service $service)
    {
        $this->service = $service;
    }

    public function index()
    {
        return view('dashboard.services.home');
    }

    public function dataTable(Request $request)
    {
        return DataTable::GenerateTable($request, $this->service->QueryTable($request));
    }

    public function create()
    {
        return view('dashboard.services.create');
    }

    public function store(ServiceRequest $request)
    {
        $create = $this->service->create($request);

        if ($create) {
            return Response()->json([true , __('dashboard.general.create_success_alert')]);
        }

        return Response()->json([false  , __('dashboard.general.ops_alert')]);
    }

    public function show($id)
    {
        //
    }

    public function edit($id)
    {
        $service  = $this->service->findById($id);

        if (!$service)
            return abort(404);

        return view('dashboard.services.edit' , compact('service'));
    }

    public function update(ServiceRequest $request, $id)
    {
        if ($request->ajax()){

            $update = $this->service->update($request , $id);

            if($update){
                return Response()->json([true , __('dashboard.general.update_success_alert')]);
            }

            return Response()->json([false  , __('dashboard.general.ops_alert')]);
        }
    }

    public function destroy($id)
    {
        try {
            $repose = $this->service->delete($id);

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
            $repose = $this->service->deleteAll($request);

            if ($repose) {
                return Response()->json([true, __('dashboard.general.delete_success_alert')]);
            }

            return Response()->json([false  , __('dashboard.general.ops_alert')]);
        } catch (\PDOException $e) {
            return Response()->json([false, $e->errorInfo[2]]);
        }
    }
}
