<?php

namespace App\Http\Controllers\api\v1;

use App\Http\Controllers\Controller;
use App\Models\FSystem;
use Illuminate\Http\Request;

class FSystemController extends Controller
{
    public function index(){

        $fsystems = FSystem::all(); //no pagination
        return response()->json(
            [
                "code" => 200,
                'mesage' => 'OK',
                "data" => $fsystems->toArray()
            ],
            200
        );
    }

    public function show($id)
    {
        $fsystem = FSystem::find($id);
 
        if (!$fsystem) {
            return response()->json([
                'code' => 404,
                'success' => false,
                'message' => 'System not found '
            ], 200);
        }

        return response()->json([
            'code' => 200,
            'success' => true,
            'message' => 'OK',
            'data' => $fsystem->toArray()
        ], 200);
    }

    public function series($id){
        $fsystem = FSystem::find($id);
        if($fsystem == null){
            return response()->json([
                "statusCode" => 404,
                "data" => json_encode($fsystem)
            ]); 
        }

        $all_series= $fsystem->series;
        
        return response()->json([
            "statusCode" => 200,
            "data" => $all_series->toArray()
        ]);
    }
}
