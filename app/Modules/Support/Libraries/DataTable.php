<?php

namespace App\Modules\Support\Libraries;

trait DataTable
{
    // DataTable Methods
    public static function GenerateTable($request,$query)
         {
             $sort['col'] = $request->input('columns.' . $request->input('order.0.column') . '.data');
             $sort['dir'] = $request->input('order.0.dir');
             $search      = $request->input('search.value');

             $output['recordsTotal']    = $query->count();
             $output['recordsFiltered'] = $query->count();


             $output['draw']            = intval($request->input('draw'));

             // Get Data
             $models = $query
                     ->orderBy($sort['col'], $sort['dir'])
                     ->skip($request->input('start'))
                     ->take($request->input('length',10))
                     ->get();

             $output['data']  = $models;

             return Response()->json($output);
         }


             public static function GenerateTable2($request,$query)
             {
                 $sort['col'] = $request->input('columns.' . $request->input('order.0.column') . '.data');
                 $sort['dir'] = $request->input('order.0.dir');
                 $search      = $request->input('search.value');

                 $output['recordsTotal']    = $query->count();
                 $output['recordsFiltered'] = $query->count();
                 $output['total_price']     = $query->sum('price');



                 $output['draw']            = intval($request->input('draw'));

                 // Get Data
                 $models = $query
                         ->orderBy($sort['col'], $sort['dir'])
                         ->skip($request->input('start'))
                         ->take($request->input('length',10))
                         ->get();

                 $output['data']  = $models;

                 return Response()->json($output);
             }
}
