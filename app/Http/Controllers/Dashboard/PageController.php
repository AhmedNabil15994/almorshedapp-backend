<?php

namespace App\Http\Controllers\Dashboard;

use App\Modules\Pages\Repository\PageRepository as Page;
use App\Modules\Pages\Requests\PageRequest;
use Illuminate\Http\Request;
use DataTable;

class PageController extends DashboardController
{
    public function __construct(Page $page)
    {
        $this->page = $page;
    }

    public function index()
    {
        return view('dashboard.pages.home');
    }

    public function dataTable(Request $request)
    {
        return DataTable::GenerateTable($request, $this->page->QueryTable($request));
    }

    public function create()
    {
        return view('dashboard.pages.create');
    }

    public function store(PageRequest $request)
    {
        $create = $this->page->create($request);

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
        $page  = $this->page->findById($id);

        if (!$page)
            return abort(404);

        return view('dashboard.pages.edit' , compact('page'));
    }

    public function update(PageRequest $request, $id)
    {
        if ($request->ajax()){

            $update = $this->page->update($request , $id);

            if($update){
                return Response()->json([true , __('dashboard.general.update_success_alert')]);
            }

            return Response()->json([false  , __('dashboard.general.ops_alert')]);
        }
    }

    public function destroy($id)
    {
        try {
            $repose = $this->page->delete($id);

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
            $repose = $this->page->deleteAll($request);

            if ($repose) {
                return Response()->json([true, __('dashboard.general.delete_success_alert')]);
            }

            return Response()->json([false  , __('dashboard.general.ops_alert')]);
        } catch (\PDOException $e) {
            return Response()->json([false, $e->errorInfo[2]]);
        }
    }
}
