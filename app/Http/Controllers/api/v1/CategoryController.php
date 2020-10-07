<?php

namespace App\Http\Controllers\api\v1;

use App\Http\Controllers\Controller;
use App\Models\Category;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\User;

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
}
