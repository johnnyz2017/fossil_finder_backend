<?php

namespace App\Http\Controllers\api\v1;

use App\Http\Controllers\Controller;
use App\Models\FStage;
use Illuminate\Http\Request;

class FStageController extends Controller
{
    public function show($id)
    {
        $fstage = FStage::find($id);
 
        if (!$fstage) {
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
            'data' => $fstage->toArray()
        ], 200);
    }
}
