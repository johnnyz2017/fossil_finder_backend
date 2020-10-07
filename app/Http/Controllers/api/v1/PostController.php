<?php

namespace App\Http\Controllers\api\v1;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
// use App\Models\User;
use App\Models\Post;


class PostController extends Controller
{
    public function index(){
        
        $posts = Post::all();
        // foreach($posts as $post){
        //     echo $post;
        // }

        return response()->json(
            [
                "statusCode" => 200,
                "data" => json_encode($posts)
            ]
        );
    }

    public function category ($id) {
        $posts = \App\Models\Post::find($id);
        if($posts == null){
            return response()->json([
                "statusCode" => 200,
                "data" => json_encode($posts)
            ]);
        }
        $category = $posts->category;
        return response()->json([
            "statusCode" => 200,
            "data" => json_encode($category)
        ]);
    }

    
}
