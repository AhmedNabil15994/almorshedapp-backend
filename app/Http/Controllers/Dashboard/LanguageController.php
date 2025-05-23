<?php

namespace App\Http\Controllers\Dashboard;

use App\Modules\Languages\Repository\LanguageRepository as Language;
use App\Modules\Languages\Requests\LanguageRequest;
use Illuminate\Http\Request;
use DataTable;

class LanguageController extends DashboardController
{
    public function __construct(Language $language)
    {
        $this->language = $language;
    }

    public function index()
    {
        return view('dashboard.languages.home');
    }

    public function dataTable(Request $request)
    {
        return DataTable::GenerateTable($request, $this->language->QueryTable($request));
    }

    public function create()
    {
        return view('dashboard.languages.create');
    }

    public function store(LanguageRequest $request)
    {
        $create = $this->language->create($request);

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
        $language  = $this->language->findById($id);

        if (!$language)
            return abort(404);

        return view('dashboard.languages.edit' , compact('language'));
    }

    public function update(LanguageRequest $request, $id)
    {
        if ($request->ajax()){

            $update = $this->language->update($request , $id);

            if($update){
                return Response()->json([true , __('dashboard.general.update_success_alert')]);
            }

            return Response()->json([false  , __('dashboard.general.ops_alert')]);
        }
    }

    public function destroy($id)
    {
        try {
            $repose = $this->language->delete($id);

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
            $repose = $this->language->deleteAll($request);

            if ($repose) {
                return Response()->json([true, __('dashboard.general.delete_success_alert')]);
            }

            return Response()->json([false  , __('dashboard.general.ops_alert')]);
        } catch (\PDOException $e) {
            return Response()->json([false, $e->errorInfo[2]]);
        }
    }
}
