<?php

namespace App\Http\Controllers\api\v1;

use App\Http\Controllers\Controller;
use App\Models\Category;
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

    public function addUser($id){
        //
    }

    public function sharedUsers($id) {
        $post = \App\Models\Post::find($id);
        
        if($post == null){
            return response()->json([
                'code' => 404,
                'success' => false,
                'message' => 'Post not found',
                'data' => []
            ], 404);
        }

        $sharedUsers = $post->sharedUsers;
        if(!$sharedUsers){
            return response()->json([
                'code' => 404,
                'success' => false,
                'message' => 'shared users not found',
                'data' => []
            ], 404);
        }

        return response()->json([
            'code' => 200,
            'success' => true,
            'message' => 'OK',
            "data" => $sharedUsers->toArray()
        ], 200);
    }

    public function removeSharedUsers(Request $request, $id) {
        // $user = auth()->user();
        // if($user == null)
        //     return response()->json([
        //         'message' => '用户验证失败',
        //         'code' => 401
        //     ], 200);

        $post = \App\Models\Post::find($id);
        if($post == null){
            return response()->json([
                'code' => 404,
                'success' => false,
                'message' => '记录未发现',
                'data' => []
            ], 200);
        }

        // if($post->user_id != $user->id){
        //     return response()->json([
        //         'message' => '非所有者无法更新',
        //         'code' => 401
        //     ], 200);
        // }

        $data = $this->validate($request, [
            'email' => 'required | email',
        ]);
        $sharedUser = User::where('email', '=', $data['email'])->first();
        if($sharedUser == null){
            return response()->json([
                'code' => 404,
                'success' => false,
                'message' => '指定共享人员邮箱不正确，共享失败',
                'data' => []
            ], 200);
        }

        $post->sharedUsers()->detach($sharedUser->id);

        $sharedUsers = $post->sharedUsers;
        if(!$sharedUsers){
            return response()->json([
                'code' => 404,
                'success' => false,
                'message' => '共享用户邮箱未发现',
                'data' => []
            ], 200);
        }

        return response()->json([
            'code' => 200,
            'success' => true,
            'message' => 'OK',
            "data" => $sharedUsers->toArray()
        ], 200);
    }

    public function addSharedUsers(Request $request, $id) {
        $user = auth()->user();
        if($user == null)
            return response()->json([
                'message' => '用户验证失败',
                'code' => 401
            ], 200);

        $post = \App\Models\Post::find($id);
        if($post == null){
            return response()->json([
                'code' => 404,
                'success' => false,
                'message' => '记录不存在',
                'data' => []
            ], 200);
        }

        if($post->user_id != $user->id){
            return response()->json([
                'message' => '非所有者无法更新',
                'code' => 401
            ], 200);
        }

        $data = $this->validate($request, [
            'email' => 'required | email',
        ]);
        $sharedUser = User::where('email', '=', $data['email'])->first();
        if($sharedUser == null){
            return response()->json([
                'code' => 404,
                'success' => false,
                'message' => '指定被分享人员邮箱不正确，共享失败',
                'data' => []
            ], 200);
        }

        if($post->sharedUsers()->count() > 0){
            foreach($post->sharedUsers as $u){
                if($u->id == $sharedUser->id){
                    return response()->json([
                        'code' => 301,
                        'success' => false,
                        'message' => '已分享给该指定人员',
                        'data' => $post->sharedUsers->toArray()
                    ], 200);
                }
            }
        }



        $post->sharedUsers()->attach($sharedUser->id);

        $sharedUsers = $post->sharedUsers;
        if(!$sharedUsers){
            return response()->json([
                'code' => 404,
                'success' => false,
                'message' => '分享用户未发现',
                'data' => []
            ], 200);
        }

        return response()->json([
            'code' => 200,
            'success' => true,
            'message' => 'OK',
            "data" => $sharedUsers->toArray()
        ], 200);
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
                'code' => 404,
                'success' => false,
                'message' => 'Post not found '
            ], 200);
        }

        $user = auth()->user();
        if($post->private == 1 || $post->published == 0){
            if($post->user_id != $user->id){
                $sharedUsers = $post->sharedUsers;
                $existed = false;
                if(count($sharedUsers) > 0){
                    foreach($sharedUsers as $u){
                        if($user->id == $u->id)
                          $existed = true;
                    }
                }
                if(!$existed)
                    return response()->json([
                        'code' => 302,
                        'success' => false,
                        'message' => '私有/未发布记录只有发布人和被共享者可以访问'
                    ], 200);
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
            // 'coordinate_latitude' => 'required | regex:/^[0-9]+(\.[0-9]{1,6})?$/',
            // 'coordinate_longitude' => 'required | regex:/^[0-9]+(\.[0-9]{1,6})?$/',
            // 'coordinate_latitude' => 'required | regex:/^[0-9]+(\.[0-9]{1,6})?$/',
            // 'coordinate_longitude' => 'required | regex:/^[0-9]+(\.[0-9]{1,6})?$/',
            // 'coordinate_latitude' => 'required | regex:/^\d+(\.\d+)?$/',
            // 'coordinate_longitude' => 'required | regex:/^\d+(\.\d+)?$/',
            // 'coordinate_latitude' => 'required | digits_between: -90, 90',
            // 'coordinate_longitude' => 'required | digits_between: -180, 180',
            // 'coordinate_altitude' => 'digits_between: -1000, 5000',
            'coordinate_latitude' => 'required',
            'coordinate_longitude' => 'required',
            'coordinate_altitude' => '',
            // 'coordinate_latitude' => 'required | regex:/^[0-9]+(\.[0-9][0-9]?)?$/',
            // 'coordinate_longitude' => 'required | regex:/^[0-9]+(\.[0-9][0-9]?)?$/',
            // 'coordinate_altitude' => 'regex:/^[0-9]+(\.[0-9][0-9]?)?$/',
            'address' => '',
            'system' => '',
            'series' => '',
            'stage' => '',
            'category_id' => '',
            'private' => ''
        ]);

        $data['temp_id'] = uniqid(); //create tempory id
        $data['user_id'] = $user->id;

        Post::create($data);

        return response()->json([
            'message' => 'OK',
            'code' => 200
        ], 200);
    }

    public function destroy(Request $request, $id){
        $user = auth()->user();
        if($user == null)
            return response()->json([
                'message' => 'Failed to find user',
                'code' => 401
            ], 401);

        $post = Post::find($id);
        if($post->user_id != $user->id){
            return response()->json([
                'message' => 'Not the owner or admin',
                'code' => 401
            ], 401);
        }

        $post->delete();

        return response()->json([
            'code' => 200,
            'message' => 'OK'
        ], 200);
    }

    public function update(Request $request, $id){
        $user = auth()->user();
        if($user == null)
            return response()->json([
                'message' => 'Failed to find user',
                'code' => 401
            ], 401);

        $post = Post::find($id);
        if($post->user_id != $user->id){
            return response()->json([
                'message' => 'Not the owner or admin',
                'code' => 401
            ], 401);
        }

        $data = $this->validate($request, [
            'title' => 'required',
            'content' => 'required',
            'images' => 'required',
            'coordinate_latitude' => 'required',
            'coordinate_longitude' => 'required',
            'coordinate_altitude' => '',
            // 'coordinate_latitude' => 'required | regex:/^[0-9]+(\.[0-9][0-9]?)?$/',
            // 'coordinate_longitude' => 'required | regex:/^[0-9]+(\.[0-9][0-9]?)?$/',
            // 'coordinate_altitude' => 'regex:/^[0-9]+(\.[0-9][0-9]?)?$/',
            'address' => '',
            'system' => '',
            'series' => '',
            'stage' => '',
            'category_id' => '',
            'private' => ''
        ]);

        // $data['private'] = (int)$data['private']; //ERROR false/true => 0

        $post->update($data);

        return response()->json([
            'code' => 200,
            'message' => 'OK'
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

    public function search(Request $request){
        $search_key = $request['search_key'];
        $search_type = $request['type'];
        switch($search_type){
            case 'title': 
                $result = Post::where('title', 'like', '%'.$search_key.'%')->get();

                return response()->json([
                    'code' => 200,
                    'paginated' => false,
                    'success' => true,
                    'data' => $result->toArray()
                ]);
            case 'author': 
                $result = Post::whereHas('user', function($query) use ($search_key){
                    $query->where('name', 'like', '%'.$search_key.'%');
                })->get();
                
                return response()->json([
                    'code' => 200,
                    'paginated' => false,
                    'success' => true,
                    'data' => $result->toArray()
                ]);
            case 'category': 
                $result = Post::whereHas('category', function($query) use ($search_key){
                    $query->where('title', 'like', '%'.$search_key.'%');
                })->get();

                return response()->json([
                    'code' => 200,
                    'paginated' => false,
                    'success' => true,
                    'data' => $result->toArray()
                ]);
            case 'all' :
                default:
                $result1 = Post::where('title', 'like', '%'.$search_key.'%')->get();
                $result2 = Post::whereHas('user', function($query) use ($search_key){
                    $query->where('name', 'like', '%'.$search_key.'%');
                })->get();
                $result3 = Post::whereHas('category', function($query) use ($search_key){
                    $query->where('title', 'like', '%'.$search_key.'%');
                })->get();
                $result = $result1->merge($result2);
                $result = $result->merge($result3);

                //get users ids
                //get categories id
                // $result = Post::where(function($query) use ($search_key){
                //     $query->where('title', 'like', '%'.$search_key.'%');
                //     // $query->where('name', 'like', '%'.$search_key.'%');
                //     // $query->where('title', 'like', '%'.$search_key.'%');
                // })->get();

                return response()->json([
                    'code' => 200,
                    'paginated' => false,
                    'success' => true,
                    'data' => $result->toArray()
                ]);
        }
    }
}
