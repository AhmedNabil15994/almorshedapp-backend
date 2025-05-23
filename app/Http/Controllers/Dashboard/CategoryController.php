<?php

namespace App\Http\Controllers\Dashboard;

use App\Modules\Categories\Repository\CategoryRepository as Category;
use App\Modules\Categories\Requests\CategoryRequest;
use Illuminate\Http\Request;
use DataTable;

class CategoryController extends DashboardController
{
    public function __construct(Category $category)
    {
        $this->category = $category;
    }

    public function index()
    {
        return view('dashboard.categories.home');
    }

    public function dataTable(Request $request)
    {
        return DataTable::GenerateTable($request, $this->category->QueryTable($request));
    }

    public function create()
    {
        $mainCats = $this->category->allMainCats();
        return view('dashboard.categories.create',compact('mainCats'));
    }

    public function store(CategoryRequest $request)
    {
        $create = $this->category->create($request);

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
        $mainCats = $this->category->allMainCats();
        $category  = $this->category->findById($id);

        if (!$category)
            return abort(404);

        return view('dashboard.categories.edit' , compact('category','mainCats'));
    }

    public function update(CategoryRequest $request, $id)
    {
        if ($request->ajax()){

            $update = $this->category->update($request , $id);

            if($update){
                return Response()->json([true , __('dashboard.general.update_success_alert')]);
            }

            return Response()->json([false  , __('dashboard.general.ops_alert')]);
        }
    }

    public function destroy($id)
    {
        try {
            $repose = $this->category->delete($id);

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
            $repose = $this->category->deleteAll($request);

            if ($repose) {
                return Response()->json([true, __('dashboard.general.delete_success_alert')]);
            }

            return Response()->json([false  , __('dashboard.general.ops_alert')]);
        } catch (\PDOException $e) {
            return Response()->json([false, $e->errorInfo[2]]);
        }
    }
}
