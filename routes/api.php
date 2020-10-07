<?php

use App\Http\Controllers\api\v1\CategoryController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

use App\Http\Controllers\api\v1\LoginController;
use App\Http\Controllers\api\v1\PostController;
use App\Http\Controllers\api\v1\UserController;
use App\Models\Category;
use App\Models\Post;
use App\Models\User;
use Illuminate\Support\Facades\DB;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::middleware('auth:api')->get('/user', function (Request $request) {
    return $request->user();
});

//OK
Route::post('v1/register', [LoginController::class, 'register']);
// Route::post('v1/register', function(Request $request){
//     return response()->json([
//         'statusCode' => 300
//     ]);
// });
Route::post('v1/login', [LoginController::class, 'login']);
Route::get('v1/test', [LoginController::class, 'test'])->middleware('auth:api');

Route::get('v1/post', [PostController::class, 'index']);

// Route::get('v1/post', function () {        
//     $posts = \App\Models\Post::all();

//     // foreach($posts as $post){
//     //     echo $post;
//     // }

//     return response()->json([
//         "statusCode" => 200,
//         "data" => json_encode($posts)
//     ]);
// });

Route::get('v1/post/{id}/category', [PostController::class, 'category']);
Route::get('v1/post/{id}/user', [UserController::class, 'posts']);

Route::get('v1/category/{id}/childs', [CategoryController::class, 'childs']);
Route::get('v1/category/posts', [CategoryController::class, 'posts']);

Route::get('v1/category', function () {
    $category = Category::with('childs')->get();

    return $category->toArray();
});

Route::get('v1/users', function () {
    // $user->hasRole('owner');   // false
    // $user->hasRole('admin');   // true
    // $user->isAbleTo('edit-user');   // false
    // $user->isAbleTo('create-post'); // true
    // $user = App\Models\User::with('roles')->first();
    // $user = User::whereRoles('administrator')->get(); //select * from `users` where `roles` = administrator
    $user = User::all()->first();
    // echo $user->hasRole('administrator'); //Column not found: 1054 Unknown column 'roles' in 'where clause' (SQL: select * from `users` where `roles` = administrator)

    //$email = DB::table('users')->where('name', 'John')->value('email');
    $role_id = DB::table('role_user')->where('user_id', $user->id)->value('role_id');
    // echo $role_id;
    // $user_type = DB::table('role_user')->where('user_id', $user->id)->value('user_type');
    // echo $user_type;
    if($role_id < 3){
        echo 'admin or super admin';
    }else{
        echo 'non admin';
    }

    // return $user->toJson();
    return $user->toArray();
});