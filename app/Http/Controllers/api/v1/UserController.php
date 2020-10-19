<?php

namespace App\Http\Controllers\api\v1;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;

class UserController extends Controller
{
    public function index(){
        $users = User::all();

        return $users->toArray();
    }

    public function posts(){
        return $this->hasMany(Post::class);
    }

    public function post($id){
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

    public function comments($id){
        $user = User::find($id);
        if($user == null){
            return response()->json([
                "statusCode" => 200,
                "data" => json_encode($user)
            ]);
        }
        $comments = $user->comments;

        return response()->json([
            "statusCode" => 200,
            "data" => json_encode($comments)
        ]);
    }
}
