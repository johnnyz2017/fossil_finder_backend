<?php

namespace App\Http\Controllers\api\v1;

use App\Http\Controllers\Controller;
use App\Models\FSeries;
use Illuminate\Http\Request;

class FSeriesController extends Controller
{
    public function show($id)
    {
        $fseries = FSeries::find($id);
 
        if (!$fseries) {
            return response()->json([
                'code' => 404,
                'success' => false,
                'message' => 'Series not found '
            ], 200);
        }

        return response()->json([
            'code' => 200,
            'success' => true,
            'message' => 'OK',
            'data' => $fseries->toArray()
        ], 200);
    }

    public function stages($id){
        $fseries = FSeries::find($id);
        if($fseries == null){
            return response()->json([
                "statusCode" => 404,
                "data" => json_encode($fseries),
                'message' => 'Series not found '
            ]); 
        }

        $all_stages= $fseries->stages;
        
        return response()->json([
            "statusCode" => 200,
            // "data" => json_encode($all_stages)
            "data" => $all_stages->toArray()
        ]);
    }
}
