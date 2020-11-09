<?php

namespace App\Http\Controllers\api\v1;

use App\Http\Controllers\Controller;
use App\Models\Category;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\User;
use Illuminate\Support\Facades\DB;

class CategoryController extends Controller
{
    

    public function posts(){

        $user = Category::with('posts')->get();

        return response()->json(
            [
                'statusCode' => 200,
                'data' => $user->toArray()
            ]
        );

        // $category = Category::with('posts')->get();
        // // $category = Category::all();
    
        // // foreach($category as $cat){
        // //     $posts = $cat->posts;
        // //     //echo "###############";
        // //     //echo $post;
        // //     $cat->post = $posts;
        // // }
        
        // return response()->json([
        //     "statusCode" => 200,
        //     "data" => json_encode($category)
        // ]);
    }

    public function childs($id){
        $category = Category::find($id);
        if($category == null){
            return response()->json([
                "statusCode" => 200,
                "data" => json_encode($category)
            ]); 
        }

        $all_categories = $category->childs;
        
        return response()->json([
            "statusCode" => 200,
            "data" => json_encode($all_categories)
        ]);
    }

    public function hi(){
        // $data = DB::table('categories')->select()->where('parent_id', '=', '0')->get();
        // $data = Category::where('parent_id', '=', '0')->firstOrFail();
        // $data = Category::where('parent_id', '=', '0')->value();
        $root = Category::find(0);
        if($root == null){
            return response()->json([
                "statusCode" => 404,
                'mesage' => 'no data found',
                "data" => ''
            ], 404);
        }
        // dd($root);
        if($root->count() == 0){
            return response()->json([
                "statusCode" => 404,
                'mesage' => 'no data found',
                "data" => json_encode($root)
            ], 400);
        }

        // $ndata = [];
        // for($i = 0; $i < $data->count(); $i ++){
        //     $d = $data[$i];
        //     // $d['children'] = [];
        //     array_push($ndata, $d);
        // }

        $ch = $root->toChildrenPostArray();
        // $ch = $root->toOrigArray();
        // dd($array['children']);

        // dd($root->childs);

        // $ndata = [];
        // for($i = 0; $i < $root->childs->count(); $i++){
        //     $d = $root->childs[$i];
        //     // $d['children'] = [];
        //     array_push($ndata, $d);
        // }

        // $root['children'] = $ndata;

        return response()->json(
            [
                $ch
            ]
        );
        // return response()->json([
        //     "statusCode" => 200,
        //     "data" => $ch
        // ]);
    }


    public function allWithPosts(){
        $root = Category::find(0);
        if($root == null){
            return response()->json([
                "statusCode" => 404,
                'mesage' => 'no data found',
                "data" => ''
            ], 404);
        }

        if($root->count() == 0){
            return response()->json([
                "statusCode" => 404,
                'mesage' => 'no data found',
                "data" => json_encode($root)
            ], 400);
        }

        $ch = $root->toChildrenPostArray();

        return response()->json([
            "statusCode" => 200,
            'mesage' => 'query successfully',
            "data" => $ch
        ], 200);
    }

    public function allWithoutPosts(){
        $root = Category::find(0);
        if($root == null){
            return response()->json([
                "statusCode" => 404,
                'mesage' => 'no data found',
                "data" => ''
            ], 404);
        }

        if($root->count() == 0){
            return response()->json([
                "statusCode" => 404,
                'mesage' => 'no data found',
                "data" => json_encode($root)
            ], 400);
        }

        $ch = $root->toChildrenArray();

        return response()->json([
            "statusCode" => 200,
            'mesage' => 'query successfully',
            "data" => $ch
        ], 200);
    }
}
