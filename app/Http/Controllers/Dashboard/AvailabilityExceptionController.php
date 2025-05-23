<?php

namespace App\Http\Controllers\Dashboard;

use App\Modules\AvailabilityExceptions\Repository\AvailabilityExceptionRepository as AvailabilityException;
use App\Modules\AvailabilityExceptions\Requests\AvailabilityExceptionRequest;
use Illuminate\Http\Request;
use DataTable;

class AvailabilityExceptionController extends DashboardController
{
    public function __construct(AvailabilityException $availability)
    {
        $this->availability = $availability;
    }

    public function index()
    {
        return view('dashboard.availability-exceptions.home');
    }

    public function dataTable(Request $request)
    {
        return DataTable::GenerateTable($request, $this->availability->QueryTable($request, $request->get('doctor_id')));
    }

    public function create($doctor_id)
    {
        return view('dashboard.availability-exceptions.create', compact('doctor_id'));
    }

    public function store(AvailabilityExceptionRequest $request)
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

        return view('dashboard.availability-exceptions.edit' , compact('availability'));
    }

    public function update(AvailabilityExceptionRequest $request, $id)
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
