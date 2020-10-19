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
                'mesage' => 'success to get posts',
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

    public function comments ($id){
        $posts = \App\Models\Post::find($id);
        if($posts == null){
            return response()->json([
                "statusCode" => 200,
                "data" => json_encode($posts)
            ]);
        }
        $comment = $posts->comments;
        return response()->json([
            "statusCode" => 200,
            "data" => json_encode($comment)
        ]);
    }
    
    public function storeImage(Request $req){

        $input = $req->all();
        $final_path = '';

        // if($req->hasFile('image')){
        //     // echo 'found image file in the request <br>';

        //     $dest_path = 'public/images/posts';
        //     $access_path = '/storage/images/posts/';
        //     $image = $req->file('image');
        //     $image_name = $image->getClientOriginalName();

        //     echo 'try to create file: ',$image_name; //QQ20200704-2.jpg
        //     $path = $req->file('image')->storeAs($dest_path, $image_name);

        //     //echo $path; //public/images/posts/QQ20200704-2.jpg //ERROR to access
        //     //echo ' : ',$access_path,'/',$image_name; //RIGHT to access
        //     $final_path = $access_path.$image_name;
        //     // echo url()->current();
        //     // echo url($final_path);

        //     // $input['image'] = $image_name; //use image_name
        //     // '/storage/images/posts'
        // }

        return response()->json([
            'statusCode' => 200,
            'mesage' => 'success to store image',
            'image_url' => url($final_path)
        ], 200);

    }

    //^^
    // public function index()
    // {
    //     $posts = auth()->user()->posts;
 
    //     return response()->json([
    //         'success' => true,
    //         'data' => $posts
    //     ]);
    // }
 
    // public function show($id)
    // {
    //     $post = auth()->user()->posts->find($id);
 
    //     if (!$post) {
    //         return response()->json([
    //             'success' => false,
    //             'message' => 'Post not found '
    //         ], 400);
    //     }
 
    //     return response()->json([
    //         'success' => true,
    //         'data' => $post->toArray()
    //     ], 400);
    // }
 
    // public function store(Request $request)
    // {
    //     $this->validate($request, [
    //         'title' => 'required',
    //         'description' => 'required'
    //     ]);
 
    //     $post = new Post();
    //     $post->title = $request->title;
    //     $post->description = $request->description;
 
    //     if (auth()->user()->posts->save($post))
    //         return response()->json([
    //             'success' => true,
    //             'data' => $post->toArray()
    //         ]);
    //     else
    //         return response()->json([
    //             'success' => false,
    //             'message' => 'Post not added'
    //         ], 500);
    // }
 
    // public function update(Request $request, $id)
    // {
    //     $post = auth()->user()->posts->find($id);
 
    //     if (!$post) {
    //         return response()->json([
    //             'success' => false,
    //             'message' => 'Post not found'
    //         ], 400);
    //     }
 
    //     $updated = $post->fill($request->all())->save();
 
    //     if ($updated)
    //         return response()->json([
    //             'success' => true
    //         ]);
    //     else
    //         return response()->json([
    //             'success' => false,
    //             'message' => 'Post can not be updated'
    //         ], 500);
    // }
 
    // public function destroy($id)
    // {
    //     $post = auth()->user()->posts->find($id);
 
    //     if (!$post) {
    //         return response()->json([
    //             'success' => false,
    //             'message' => 'Post not found'
    //         ], 400);
    //     }
 
    //     if ($post->delete()) {
    //         return response()->json([
    //             'success' => true
    //         ]);
    //     } else {
    //         return response()->json([
    //             'success' => false,
    //             'message' => 'Post can not be deleted'
    //         ], 500);
    //     }
    // }
}
