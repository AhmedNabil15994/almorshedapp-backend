<?php

namespace App\Http\Controllers\Api\V1\UserApp;

use App\Http\Controllers\Api\ApiController;
use Illuminate\Http\Request;

class OrderController extends ApiController
{

    /**
     * Create a new controller instance.
     */
    public function __construct()
    {
        //
    }

    public function store(Request $request)
    {
        //store order
        if ($request->type == 'assessment') {
            auth()->user()->assessmentOrders()->create([
                'assessment_id' => $request->model_id,
                'status' => 0,
                'price' => $request->price,
            ]);
        } else {

        }

        //process payment

        //redirect
        return redirect($request->redirectUrl);
    }

}
