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

    // public function publicPostsViaAuth(){
    //     $auser = auth()->user();
    //     $user = User::find($auser->id);
    // }

    // public function privatePostsViaAuth(){
    //     $auser = auth()->user();
    // }

    public function self(){
        $auser = auth()->user();
        $user = User::find($auser->id);

        if($user == null){
            return response()->json([
                'message' => 'Failed to find user',
                'code' => 401
            ], 401);
        }

        return response()->json([
            "code" => 200,
            "data" => $user->toArray(),
            'message' => 'OK'
        ], 200);
    }

    public function show($id){
        $user = User::find($id);

        return response()->json([
            "code" => 200,
            "data" => $user->toArray(),
            'message' => 'OK'
        ], 200);
    }

    public function postsviaauth(){
        // return $this->hasMany(Post::class);
        $user = auth()->user();
        // dd($user);
        if($user == null)
            return response()->json([
                'message' => 'Failed to find user',
                'code' => 401
            ], 401);
        
        $posts = $user->posts;
        // dd($posts);
        // dd($posts);
        return response()->json([
            "code" => 200,
            "data" => $posts->toArray()
        ], 200);
    }

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
