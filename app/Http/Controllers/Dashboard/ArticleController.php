<?php

namespace App\Http\Controllers\Dashboard;

use App\Modules\Articles\Repository\ArticleRepository as Article;
use App\Modules\Articles\Requests\ArticleRequest;
use Illuminate\Http\Request;
use DataTable;

class ArticleController extends DashboardController
{
    public function __construct(Article $article)
    {
        $this->article = $article;
    }

    public function index()
    {
        return view('dashboard.articles.home');
    }

    public function dataTable(Request $request)
    {
        return DataTable::GenerateTable($request, $this->article->QueryTable($request));
    }

    public function create()
    {
        return view('dashboard.articles.create');
    }

    public function store(ArticleRequest $request)
    {
        $create = $this->article->create($request);

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
        $article  = $this->article->findById($id);

        if (!$article)
            return abort(404);

        return view('dashboard.articles.edit' , compact('article'));
    }

    public function update(ArticleRequest $request, $id)
    {
        if ($request->ajax()){

            $update = $this->article->update($request , $id);

            if($update){
                return Response()->json([true , __('dashboard.general.update_success_alert')]);
            }

            return Response()->json([false  , __('dashboard.general.ops_alert')]);
        }
    }

    public function destroy($id)
    {
        try {
            $repose = $this->article->delete($id);

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
            $repose = $this->article->deleteAll($request);

            if ($repose) {
                return Response()->json([true, __('dashboard.general.delete_success_alert')]);
            }

            return Response()->json([false  , __('dashboard.general.ops_alert')]);
        } catch (\PDOException $e) {
            return Response()->json([false, $e->errorInfo[2]]);
        }
    }
}
