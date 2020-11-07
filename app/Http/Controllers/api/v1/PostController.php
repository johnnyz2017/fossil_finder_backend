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

        $posts = Post::all(); //no pagination
        // $posts = DB::table('posts')->paginate(5); //no customized data
        // $posts = Post::paginate(10);

        return response()->json(
            [
                "statusCode" => 200,
                'paginated' => false,
                'mesage' => 'success to get posts',
                "data" => $posts->toArray()
            ],
            200
        );
    }

    public function category ($id) {
        $post = \App\Models\Post::find($id);
        
        if($post == null){
            return response()->json([
                'success' => false,
                'message' => 'Post not found '
            ], 404);
        }

        $category = $post->category;
        if(!$category){
            return response()->json([
                'success' => false,
                'message' => 'Category not found '
            ], 404);
        }
        // while($category->parent != null){
        //     $p = $category->parent;
        //     $p['child'] = $category;
        //     dd($p);
        //     $category = $p;
        // }

        return response()->json([
            'success' => true,
            "data" => $category->toWithAllParentsArray()
        ], 200);
    }

    public function comments ($id){
        $post = \App\Models\Post::find($id);
        if(!$post){
            return response()->json([
                "statusCode" => 404,
                "data" => $post->toArray()
            ]);
        }
        $comment = $post->comments;
        return response()->json([
            "statusCode" => 200,
            "data" => $comment->toArray()
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
 
    public function show($id)
    {
        // $post = auth()->user()->posts->find($id);
        $post = Post::find($id);
 
        if (!$post) {
            return response()->json([
                'success' => false,
                'message' => 'Post not found '
            ], 400);
        }
 
        return response()->json([
            'success' => true,
            'data' => $post->toArray()
        ], 200);
    }
 
    public function store(Request $request)
    {
        $data = $this->validate($request, [
            'title' => 'required',
            'content' => 'required',
            'images' => 'required',
            'coordinate_latitude' => 'required',
            'coordinate_longitude' => 'required',
            'coordinate_altitude' => 'required',
            'address' => 'required',
            'category_id' => 'required'
        ]);

        $data['temp_id'] = uniqid();
        // $data['category_id'] = 2;
        $data['user_id'] = 1;

        
        // $post = new Post();
        // $post->title = $request->title;
        // $post->description = $request->description;

        Post::create($data);

        return response()->json([
            'message' => 'OK',
            'code' => 200
        ], 200);

 
        // if (auth()->user()->posts->save($post))
        //     return response()->json([
        //         'success' => true,
        //         'data' => $post->toArray()
        //     ]);
        // else
        //     return response()->json([
        //         'success' => false,
        //         'message' => 'Post not added'
        //     ], 500);
    }
 
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

    public function user($id){
        $post = Post::find($id);

        if(!$post){
            return response()->json([
                'success' => false,
                'message' => 'Post not found '
            ], 400);
        }

        $user = $post->user;
        if(!$user){
            return response()->json([
                'success' => false,
                'message' => 'No User Specified'
            ], 404);
        }

        return response()->json([
            'success' => true,
            'data' => $user->toArray()
        ], 200);
    }
}
