<?php

namespace App\Http\Controllers\api\v1;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;

class UserController extends Controller
{
    public function posts($id){
        $user = User::find($id);
        if($user == null){
            return response()->json([
                "statusCode" => 200,
                "data" => json_encode($user)
            ]);
        }
        $posts = $user->posts;

        return response()->json([
            "statusCode" => 200,
            "data" => json_encode($posts)
        ]);
    }
}
