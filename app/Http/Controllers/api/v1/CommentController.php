<?php

namespace App\Http\Controllers\api\v1;

use App\Http\Controllers\Controller;
use App\Models\Comment;
use Illuminate\Http\Request;

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
            'post_id' => 'required'
        ]);

        $data['user_id'] = $user->id;

        Comment::create($data);

        return response()->json([
            'message' => 'OK',
            'code' => 200
        ], 200);
    }
}
