<?php

namespace App\Http\Controllers\Dashboard;

use App\Modules\OrderStatuses\Repository\OrderStatusRepository as OrderStatus;
use App\Modules\OrderStatuses\Requests\OrderStatusRequest;
use Illuminate\Http\Request;
use DataTable;

class OrderStatusController extends DashboardController
{
    protected $orderStatus;

    public function __construct(OrderStatus $orderStatus)
    {
        $this->orderStatus = $orderStatus;
    }

    public function index()
    {
        return view('dashboard.order-statuses.home');
    }

    public function dataTable(Request $request)
    {
        return DataTable::GenerateTable($request, $this->orderStatus->QueryTable($request));
    }

    public function create()
    {
        return view('dashboard.order-statuses.create');
    }

    public function store(OrderStatusRequest $request)
    {
        $create = $this->orderStatus->create($request);

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
        $orderStatus  = $this->orderStatus->findById($id);

        if (!$orderStatus)
            return abort(404);

        return view('dashboard.order-statuses.edit' , compact('orderStatus'));
    }

    public function update(OrderStatusRequest $request, $id)
    {
        if ($request->ajax()){

            $update = $this->orderStatus->update($request , $id);

            if($update){
                return Response()->json([true , __('dashboard.general.update_success_alert')]);
            }

            return Response()->json([false  , __('dashboard.general.ops_alert')]);
        }
    }

    public function destroy($id)
    {
        try {
            $repose = $this->orderStatus->delete($id);

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
            $repose = $this->orderStatus->deleteAll($request);

            if ($repose) {
                return Response()->json([true, __('dashboard.general.delete_success_alert')]);
            }

            return Response()->json([false  , __('dashboard.general.ops_alert')]);
        } catch (\PDOException $e) {
            return Response()->json([false, $e->errorInfo[2]]);
        }
    }
}
