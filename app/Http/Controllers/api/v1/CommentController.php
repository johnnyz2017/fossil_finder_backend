<?php

namespace App\Http\Controllers\api\v1;

use App\Http\Controllers\Controller;
use App\Models\Comment;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class CommentController extends Controller
{
    public function show($id){
        $comment = Comment::find($id);

        if (!$comment) {
            return response()->json([
                'success' => false,
                'message' => 'Post not found ',
                'code' => 400
            ], 400);
        }
 
        return response()->json([
            'success' => true,
            'data' => $comment->toArray(),
            'code' => 200
        ], 200);
    }

    public function store(Request $request){
        $user = auth()->user();
        if($user == null)
            return response()->json([
                'message' => 'Failed to find user',
                'code' => 401
            ], 401);

        $data = $this->validate($request, [
            'title' => 'required',
            'content' => 'required',
            'post_id' => 'required',
            'category_id' => ''
        ]);

        $data['user_id'] = $user->id;

        Comment::create($data);

        return response()->json([
            'message' => 'OK',
            'code' => 200
        ], 200);
    }

    public function update(Request $request, $id){
        $user = auth()->user();
        if($user == null)
            return response()->json([
                'message' => '用户验证失败',
                'code' => 401
            ], 200);

        $comment = Comment::find($id);
        if($comment->id < 1){
            return response()->json([
                'message' => '非法鉴定记录id',
                'code' => 301
            ], 200);
        }

        if($comment->user_id != $user->id){
            return response()->json([
                'message' => '无法更新其他人的记录鉴定',
                'code' => 401
            ], 200);
        }
        

        $data = $this->validate($request, [
            'title' => 'required',
            'content' => 'required',
            'post_id' => 'required',
            'category_id' => ''
        ]);

        $data['user_id'] = $user->id;

        $comment->update($data);

        return response()->json([
            'code' => 200,
            'message' => 'OK'
        ], 200);
    }
}
