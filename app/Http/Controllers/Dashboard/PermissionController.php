<?php

namespace App\Http\Controllers\Dashboard;

use App\Modules\Permissions\Repository\PermsRepository as Permission;
use App\Modules\Permissions\Requests\PermissionRequest;
use Illuminate\Http\Request;
use DataTable;

class PermissionController extends DashboardController
{
    public function __construct(Permission $permission)
    {
        $this->permission = $permission;
    }

    public function index()
    {
        return view('dashboard.permissions.home');
    }

    public function dataTable(Request $request)
    {
        return DataTable::GenerateTable($request, $this->permission->QueryTable($request));
    }

    public function create()
    {
        return view('dashboard.permissions.create');
    }

    public function store(PermissionRequest $request)
    {
        $create = $this->permission->create($request);

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
        $perm  = $this->permission->findById($id);

        if (!$perm)
            return abort(404);

        return view('dashboard.permissions.edit' , compact('perm'));
    }

    public function update(PermissionRequest $request, $id)
    {
        if ($request->ajax()){

            $update = $this->permission->update($request , $id);

            if($update){
                return Response()->json([true , __('dashboard.general.update_success_alert')]);
            }

            return Response()->json([false  , __('dashboard.general.ops_alert')]);
        }
    }

    public function destroy($id)
    {
        try {
            $repose = $this->permission->delete($id);

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
            $repose = $this->permission->deleteAll($request);

            if ($repose) {
                return Response()->json([true, __('dashboard.general.delete_success_alert')]);
            }

            return Response()->json([false  , __('dashboard.general.ops_alert')]);
        } catch (\PDOException $e) {
            return Response()->json([false, $e->errorInfo[2]]);
        }
    }
}
