<?php

namespace App\Http\Controllers\Dashboard;

use App\Modules\Permissions\Repository\PermsRepository as Permission;
use App\Modules\Roles\Repository\RoleRepository as Role;
use App\Modules\Roles\Requests\RoleRequest;
use Illuminate\Http\Request;
use DataTable;

class RoleController extends DashboardController
{
    public function __construct(Role $role,Permission $permission)
    {
        $this->permission = $permission;
        $this->role       = $role;
    }

    public function index()
    {
        return view('dashboard.roles.home');
    }

    public function dataTable(Request $request)
    {
        return DataTable::GenerateTable($request, $this->role->QueryTable($request));
    }

    public function create()
    {
        $permissions = $this->permission->getAll('id','asc');
        return view('dashboard.roles.create',compact('permissions'));
    }

    public function store(RoleRequest $request)
    {
        $create = $this->role->create($request);

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
        $permissions = $this->permission->getAll('id','asc');

        $role  = $this->role->findById($id);

        if (!$role)
            return abort(404);

        $role_perms = $role->perms()->pluck('id')->toArray();
        return view('dashboard.roles.edit' , compact('role','permissions','role_perms'));
    }

    public function update(RoleRequest $request, $id)
    {
        if ($request->ajax()){

            $update = $this->role->update($request , $id);

            if($update){
                return Response()->json([true , __('dashboard.general.update_success_alert')]);
            }

            return Response()->json([false  , __('dashboard.general.ops_alert')]);
        }
    }

    public function destroy($id)
    {
        try {

            $repose = $this->role->delete($id);

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

            $repose = $this->role->deleteAll($request);

            if ($repose) {
                return Response()->json([true, __('dashboard.general.delete_success_alert')]);
            }

            return Response()->json([false  , __('dashboard.general.ops_alert')]);

        } catch (\PDOException $e) {

            return Response()->json([false, $e->errorInfo[2]]);

        }
    }
}
