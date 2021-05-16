<?php

namespace App\Http\Controllers\api\v1;

use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use App\Models\User;
use App\Models\Post;
use Illuminate\Http\Request;
use Illuminate\Support\Arr;

class UserController extends Controller
{
    public function index(){
        $users = User::all();

        return $users->toArray();
    }

    public function self(){
        $auser = auth()->user();
        // dd(Auth::user()->roles);
        $user = User::find($auser->id);

        if($user == null){
            return response()->json([
                'message' => 'Failed to find user',
                'statusCode' => 401
            ], 200);
        }

        return response()->json([
            "statusCode" => 200,
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
        if($user == null)
            return response()->json([
                'message' => 'Failed to find user',
                'statusCode' => 401
            ], 200);
        
        $posts = $user->posts;
        return response()->json([
            "statusCode" => 200,
            "data" => $posts->toArray()
        ], 200);
    }

    public function posts($id){
        $user = User::find($id);
        if($user == null){
            return response()->json([
                "statusCode" => 401,
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
        dd($id);
        $user = User::find($id);
        if($user == null){
            return response()->json([
                "statusCode" => 401,
                "data" => json_encode($user)
            ]);
        }
        $comments = $user->comments;

        return response()->json([
            "statusCode" => 200,
            "data" => json_encode($comments)
        ]);
    }

    public function postsOfCommentsViaAuth(){
        $user = Auth::user();
        if($user == null){
            return response()->json([
                "statusCode" => 301,
                "data" => json_encode($user)
            ]);
        }
        $comments = $user->comments;
        $posts = collect([]);
        if(count($comments) > 0){
            for($index =0; $index < count($comments); $index++){
                $p_id = $comments[$index]->post_id;
                if($p_id == null) continue;
                if($posts->contains('id', $p_id)) continue;
                $post = Post::find($p_id);
                if($post != null){
                    $posts->add($post);
                }
            }
            // foreach($comments as $comment){
            //     $p_id = $comment->post_id;
            //     if($posts->contains(function($value, $p_id){
            //         return $value->id == $p_id;
            //     })) continue;
            //     if($p_id != null){
            //         $post = Post::find($p_id);
            //         if($post != null){
            //             $posts->add($post);
            //         }
            //     }
            // }
            // $posts->duplicates('id');
        }

        return response()->json([
            'code' => 200,
            "data" => $posts->toArray()
        ], 200);
    }

    public function commentsViaAuth(){
        $user = Auth::user();
        if($user == null){
            return response()->json([
                "statusCode" => 301,
                "data" => json_encode($user)
            ]);
        }
        $comments = $user->comments;

        return response()->json([
            "statusCode" => 200,
            "data" => json_encode($comments)
        ]);
    }

    public function update(Request $request, $id){
        $user = auth()->user();
        if($user == null)
            return response()->json([
                'message' => 'Failed to find user',
                'code' => 401
            ], 200);

        $muser = User::find($user->id);

        $data = $this->validate($request, [
            'name' => 'min:1 | max:50',
            'description' => '',
            'profile_image' => ''
        ]);

        if (request()->has('name')) {
            if(request('name') != '')
                $muser->name = request('name');
        }

        // if (request()->has('email')) {
        //     $muser->name = request('email');
        // }

        if (request()->has('password')) {
            if(request('password'))
            $muser->password = bcrypt(request('password'));
        }

        if (request()->has('profile_image')) {
            $muser->profile_image = request('profile_image');
        }

        if (request()->has('description')) {
            $muser->description = request('description');
        }

        $muser->save();

        return response()->json([
            'code' => 200,
            'message' => 'OK'
        ], 200);
    }

    public function changePassword(Request $request){
        $user = auth()->user();
        if($user == null)
            return response()->json([
                'message' => 'Failed to find user',
                'code' => 401
            ], 401);

        $muser = User::find($user->id);

        $data = $this->validate($request, [
            'password' => 'required | min:6',
        ]);

        if (request()->has('password')) {
            if(request('password'))
            $muser->password = bcrypt(request('password'));
        }

        $muser->save();

        return response()->json([
            'code' => 200,
            'message' => 'OK'
        ], 200);
    }
}
