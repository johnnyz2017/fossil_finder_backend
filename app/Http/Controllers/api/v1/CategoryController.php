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
    public function show($id)
    {
        // $user = auth()->user();
        // if($user == null)
        //     return response()->json([
        //         'message' => 'Failed to auth user',
        //         'code' => 401
        //     ], 200);

        $category = Category::find($id);
 
        if (!$category) {
            return response()->json([
                'code' => 404,
                'success' => false,
                'message' => 'Category not found '
            ], 200);
        }

        return response()->json([
            'code' => 200,
            'success' => true,
            'message' => 'OK',
            'data' => $category->toArray()
        ], 200);
    }

    public function showPost($id)
    {
        // $user = auth()->user();
        // if($user == null)
        //     return response()->json([
        //         'message' => 'Failed to auth user',
        //         'code' => 401
        //     ], 200);

        $category = Category::find($id);
 
        if (!$category) {
            return response()->json([
                'code' => 404,
                'success' => false,
                'message' => 'Category not found '
            ], 200);
        }

        return response()->json([
            'code' => 200,
            'success' => true,
            'message' => 'OK',
            'paginated' => false,
            'data' => $category->posts->toArray()
        ], 200);
    }

    public function posts(){

        $post = Category::with('posts')->get();

        return response()->json(
            [
                'statusCode' => 200,
                'data' => $post->toArray()
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
            ], 200);
        }
        // dd($root);
        if($root->count() == 0){
            return response()->json([
                "statusCode" => 404,
                'mesage' => 'no data found',
                "data" => json_encode($root)
            ], 200);
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
            ], 200);
        }

        if($root->count() == 0){
            return response()->json([
                "statusCode" => 404,
                'mesage' => 'no data found',
                "data" => json_encode($root)
            ], 200);
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
            ], 200);
        }

        if($root->count() == 0){
            return response()->json([
                "statusCode" => 404,
                'mesage' => 'no data found',
                "data" => json_encode($root)
            ], 200);
        }

        $ch = $root->toChildrenArray();

        return response()->json([
            "statusCode" => 200,
            'mesage' => 'query successfully',
            "data" => $ch
        ], 200);
    }

    public function user($id){
        $category = Category::find($id);
        if($category == null){
            return response()->json([
                "statusCode" => 404,
                'mesage' => 'no category found',
                "data" => ''
            ], 200);
        }

        $user_id = $category->user;
        $user = User::find($user_id);
        return response()->json([
            "statusCode" => 200,
            'mesage' => 'get category user successfully',
            "data" => $user->toArray()
        ], 200);
    }

    public function index(){
        $categories = Category::all();
        return response()->json(
            [
                "code" => 200,
                'paginated' => false,
                'mesage' => 'success to get categories',
                "data" => $categories->toArray()
            ],
            200
        );
    }

    public function store(Request $request)
    {
        $user = auth()->user();
        if($user == null)
            return response()->json([
                'message' => '用户验证失败',
                'code' => 401
            ], 200);

        $data = $this->validate($request, [
            'title' => 'required',
            'parent_id' => '',
            'description' => '',
            'is_genus' => ''
        ]);

        $count = count(Category::where('title', $data['title'])->get());
        if($count > 0){
            return response()->json([
                'message' => '分类名称不可以重复',
                'code' => 300
            ], 200);
        }

        if($request->get('parent_id') == null){
            $data['parent_id'] = 0;
        }

        $data['user_id'] = $user->id;

        Category::create($data);

        return response()->json([
            'message' => 'OK',
            'code' => 200
        ], 200);
    }

    public function destroy(Request $request, $id){
        $user = auth()->user();
        if($user == null)
            return response()->json([
                'message' => '用户验证失败',
                'code' => 401
            ], 200);

        $category = Category::find($id);
        if($category->id < 1){
            return response()->json([
                'message' => '无法删除非常规类别ID',
                'code' => 301
            ], 200);
        }
        if($category->user_id != $user->id){
            return response()->json([
                'message' => '非所有者或者管理员用户，无法删除',
                'code' => 401
            ], 200);
        }

        $category->delete();

        return response()->json([
            'code' => 200,
            'message' => 'OK'
        ], 200);
    }

    public function update(Request $request, $id){
        $user = auth()->user();
        if($user == null)
            return response()->json([
                'message' => '用户验证失败',
                'code' => 401
            ], 200);

        $category = Category::find($id);
        if($category->id < 1){
            return response()->json([
                'message' => '无法编辑非常规类别ID',
                'code' => 301
            ], 200);
        }

        if(Auth::user()->roles[0]->id > 1){
            if($category->user_id != $user->id){
                return response()->json([
                    'message' => '非所有者或者管理员用户，无法更新',
                    'code' => 401
                ], 200);
            }
        }
        

        $data = $this->validate($request, [
            'title' => 'required',
            'parent_id' => '',
            'description' => '',
            'is_genus' => ''
        ]);

        $count = count(Category::where('title', $data['title'])->get());
        if($count > 0){
            return response()->json([
                'message' => '分类名称不可以重复',
                'code' => 300
            ], 200);
        }

        $data['user_id'] = $user->id;

        $category->update($data);

        return response()->json([
            'code' => 200,
            'message' => 'OK'
        ], 200);
    }

    public function editable(Request $request, $id){
        $user = auth()->user();
        if($user == null)
            return response()->json([
                'message' => '用户验证失败',
                'code' => 401
            ], 200);

        $category = Category::find($id);
        if($category->user_id != $user->id){
            if($user->role > 2){
                return response()->json([
                    'message' => '非所有者或者管理员用户，无法编辑',
                    'code' => 401
                ], 200);
            }else{
                return response()->json([
                    'code' => 200,
                    'message' => '管理员权限'
                ], 200);
            }
        }
        
        return response()->json([
            'code' => 200,
            'message' => '所属者权限'
        ], 200);
    }

    public function deleteable(Request $request, $id){
        $user = auth()->user();
        if($user == null)
            return response()->json([
                'message' => '用户token鉴权失败',
                'code' => 401
            ], 200);

        $category = Category::find($id);
        if($category->user_id != $user->id && $user->role > 2){
            return response()->json([
                'message' => '非所有者或者管理员用户，无法操作删除',
                'code' => 401
            ], 200);
        }else if($category->childs->count() > 0 || $category->posts->count() > 0){
            return response()->json([
                'code' => 300,
                'message' => '该类别下有子类别或者记录，不能直接删除'
            ], 200);
        }else{
            return response()->json([
                'code' => 200,
                'message' => 'OK'
            ], 200);
        }
    }
}
