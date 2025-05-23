<?php

namespace App\Http\Controllers\Dashboard;

use App\Modules\Availabilities\Repository\AvailabilityRepository as Availability;
use App\Modules\Availabilities\Requests\AvailabilityRequest;
use Illuminate\Http\Request;
use DataTable;

class AvailabilityController extends DashboardController
{
    public function __construct(Availability $availability)
    {
        $this->availability = $availability;
    }

    public function index()
    {
        return view('dashboard.availabilities.home');
    }

    public function dataTable(Request $request)
    {
        return DataTable::GenerateTable($request, $this->availability->QueryTable($request, $request->get('doctor_id')));
    }

    public function create($doctor_id)
    {
        return view('dashboard.availabilities.create', compact('doctor_id'));
    }

    public function store(AvailabilityRequest $request)
    {
        $create = $this->availability->create($request);

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
        $availability  = $this->availability->findById($id);

        if (!$availability)
            return abort(404);

        return view('dashboard.availabilities.edit' , compact('availability'));
    }

    public function update(AvailabilityRequest $request, $id)
    {
        if ($request->ajax()){

            $update = $this->availability->update($request , $id);

            if($update){
                return Response()->json([true , __('dashboard.general.update_success_alert')]);
            }

            return Response()->json([false  , __('dashboard.general.ops_alert')]);
        }
    }

    public function destroy($id)
    {
        try {
            $repose = $this->availability->delete($id);

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
            $repose = $this->availability->deleteAll($request);

            if ($repose) {
                return Response()->json([true, __('dashboard.general.delete_success_alert')]);
            }

            return Response()->json([false  , __('dashboard.general.ops_alert')]);
        } catch (\PDOException $e) {
            return Response()->json([false, $e->errorInfo[2]]);
        }
    }
}
