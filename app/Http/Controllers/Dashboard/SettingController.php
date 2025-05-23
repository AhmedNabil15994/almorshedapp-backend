<?php

namespace App\Http\Controllers\Dashboard;

use	App\Modules\Setting\Repository\SettingRepository;
use Illuminate\Http\Request;

class SettingController extends DashboardController
{

    public function __construct(SettingRepository $setting)
    {
        $this->setting = $setting;
    }

    public function index()
    {
        return view('dashboard.settings.all');
    }

    public function dataTable(Request $request)
    {

    }

    public function create()
    {

    }

    public function store(Request $request)
    {
        $this->setting->set($request);

        return redirect()->back();
    }


    public function show($id)
    {

    }

    public function edit($id)
    {

    }

    public function update(Request $request, $id)
    {

    }

    public function destroy($id)
    {

    }
}
