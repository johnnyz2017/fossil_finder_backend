<?php

namespace App\Http\Controllers\api\v1;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\Post;
use App\Models\User;
use Illuminate\Support\Facades\DB;

class PostController extends Controller
{

    //GET /post
    public function index(){

        // $posts = Post::all(); //no pagination
        // $posts = DB::table('posts')->paginate(5); //no customized data
        // $posts = Post::paginate(10);

        //filter
        //$posts = Post::query()->where('private', false)->where('published', true)->orderBy('created_at', 'DESC')->paginate(5); //ASC paginated
        $posts = Post::query()->where('private', false)->where('published', true)->orderBy('created_at', 'DESC')->get(); //no paginated

        return response()->json(
            [
                "code" => 200,
                'paginated' => false,
                'mesage' => 'success to get posts',
                "data" => $posts->toArray()
            ],
            200
        );
    }

    public function publishedPostsViaAuth(){
        $auser = auth()->user();
        $posts = Post::query()->where('user_id', '=', $auser->id)->where('published', true)->get();

        return response()->json([
            'code' => 200,
            'paginated' => false,
            'success' => true,
            'message' => 'OK',
            "data" => $posts->toArray()
        ], 200);

    }

    public function unpublishedPostsViaAuth(){
        $auser = auth()->user();
        $posts = Post::query()->where('user_id', '=', $auser->id)->where('published', false)->get();

        return response()->json([
            'code' => 200,
            'paginated' => false,
            'success' => true,
            'message' => 'OK',
            "data" => $posts->toArray()
        ], 200);
    }

    public function privatePostsViaAuth(){
        $auser = auth()->user();
        $posts = Post::query()->where('user_id', '=', $auser->id)->where('private', true)->get();

        return response()->json([
            'code' => 200,
            'paginated' => false,
            'success' => true,
            'message' => 'OK',
            "data" => $posts->toArray()
        ], 200);
    }

    public function category ($id) {
        $post = \App\Models\Post::find($id);
        
        if($post == null){
            return response()->json([
                'code' => 404,
                'success' => false,
                'message' => 'Post not found',
                'data' => []
            ], 404);
        }

        $category = $post->category;
        if(!$category){
            return response()->json([
                'code' => 404,
                'success' => false,
                'message' => 'Category not found',
                'data' => []
            ], 404);
        }

        return response()->json([
            'code' => 200,
            'success' => true,
            'message' => 'OK',
            "data" => $category->toWithAllParentsArray()
        ], 200);
    }

    public function comments ($id){
        $post = \App\Models\Post::find($id);
        if(!$post){
            return response()->json([
                "code" => 404,
                'message' => 'comment not found',
                "data" => $post->toArray()
            ], 404);
        }
        $comment = $post->comments;
        return response()->json([
            "code" => 200,
            'message' => 'OK',
            "data" => $comment->toArray()
        ], 200);
    }
    
    public function storeImage(Request $req){

        $input = $req->all();
        $final_path = '';

        if($req->hasFile('image')){
            $dest_path = 'public/images/posts';
            $access_path = '/storage/images/posts/';
            $image = $req->file('image');
            $image_name = $image->getClientOriginalName();

            echo 'try to create file: ',$image_name; //QQ20200704-2.jpg
            $path = $req->file('image')->storeAs($dest_path, $image_name);

            $final_path = $access_path.$image_name;
        }

        return response()->json([
            'code' => 200,
            'mesage' => 'success to store image',
            'image_url' => url($final_path)
        ], 200);

    }
 
    public function show($id)
    {
        $post = Post::find($id);
 
        if (!$post) {
            return response()->json([
                'code' => 400,
                'success' => false,
                'message' => 'Post not found '
            ], 400);
        }

        $user = auth()->user();
        // dd($user);
        if($post->private == 1 || $post->published == 0){
            if($post->user_id != $user->id){
                return response()->json([
                    'code' => 302,
                    'success' => false,
                    'message' => 'Auth Failed'
                ], 302);
            }
        }
 
        return response()->json([
            'code' => 200,
            'success' => true,
            'message' => 'OK',
            'data' => $post->toArray()
        ], 200);
    }
 
    public function store(Request $request)
    {
        $user = auth()->user();
        if($user == null)
            return response()->json([
                'message' => 'Failed to find user',
                'code' => 401
            ], 401);

        $data = $this->validate($request, [
            'title' => 'required',
            'content' => 'required',
            'images' => 'required',
            'coordinate_latitude' => 'required',
            'coordinate_longitude' => 'required',
            'coordinate_altitude' => 'required',
            'address' => 'required',
            'category_id' => 'required',
            'private' => 'required'
        ]);

        $data['temp_id'] = uniqid();
        $data['user_id'] = $user->id;

        Post::create($data);

        return response()->json([
            'message' => 'OK',
            'code' => 200
        ], 200);
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
