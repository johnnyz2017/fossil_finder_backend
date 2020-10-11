<?php

namespace App\Http\Controllers\api\v1;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
// use App\Models\User;
use App\Models\Post;
use Illuminate\Support\Facades\DB;

class PostController extends Controller
{

    //GET /post
    public function index(){

        // $posts = Post::all(); //no pagination
        // $posts = DB::table('posts')->paginate(5); //no customized data
        $posts = Post::paginate(10);

        return response()->json(
            [
                "statusCode" => 200,
                // "data" => json_encode($posts)
                "data" => $posts->toArray()
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
    
    public function store(Request $req){

        $input = $req->all();
        $final_path = '';

        if($req->hasFile('image')){
            // echo 'found image file in the request <br>';

            $dest_path = 'public/images/posts';
            $access_path = '/storage/images/posts/';
            $image = $req->file('image');
            $image_name = $image->getClientOriginalName();

            echo 'try to create file: ',$image_name; //QQ20200704-2.jpg
            $path = $req->file('image')->storeAs($dest_path, $image_name);

            //echo $path; //public/images/posts/QQ20200704-2.jpg //ERROR to access
            //echo ' : ',$access_path,'/',$image_name; //RIGHT to access
            $final_path = $access_path.$image_name;
            // echo url()->current();
            // echo url($final_path);

            // $input['image'] = $image_name; //use image_name
            // '/storage/images/posts'
        }

        return response()->json([
            'statusCode' => 200,
            'image_url' => url($final_path)
        ]);

        // $req->validate(
        //     array(
        //         'images' => 'required:image',
        //     )
        // );

        // try{
        //     // $image = Image::
        // }
    }
}
