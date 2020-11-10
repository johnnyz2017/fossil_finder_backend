<?php

use App\Http\Controllers\api\v1\CategoryController;
use App\Http\Controllers\api\v1\CommentController;
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
Route::post('v1/login', [LoginController::class, 'login']);

Route::get('v1/test', [LoginController::class, 'test'])->middleware('auth:api');

// Route::apiResource('v1/posts', PostController::class); //OK
Route::get('v1/posts', [PostController::class, 'index'])->middleware('auth:api');
Route::get('v1/posts/{id}', [PostController::class, 'show'])->middleware('auth:api');
Route::post('v1/posts', [PostController::class, 'store'])->middleware('auth:api');

Route::get('v1/posts/{id}/category', [PostController::class, 'category']);
Route::get('v1/posts/{id}/user', [PostController::class, 'user']);

Route::get('v1/categories/{id}/childs', [CategoryController::class, 'childs']);
Route::get('v1/categories/posts', [CategoryController::class, 'posts']);
Route::get('v1/categories/hi', [CategoryController::class, 'hi']);
Route::get('v1/categories/allwithposts', [CategoryController::class, 'allWithPosts']);
Route::get('v1/categories/allwithoutposts', [CategoryController::class, 'allWithoutPosts']);
Route::get('v1/categories', [CategoryController::class, 'index']);
Route::get('v1/categories/{id}', [CategoryController::class, 'show']);

// Route::get('v1/categories', function () {
//     $category = Category::with('childs')->get();

//     return $category->toArray();
// });

Route::post('v1/comments', [CommentController::class, 'store'])->middleware('auth:api');
Route::get('v1/comments/{id}', [CommentController::class, 'show'])->middleware('auth:api');

Route::get('v1/users/{id}', [UserController::class, 'show']);
Route::get('v1/users', [UserController::class, 'index']);
Route::get('v1/self', [UserController::class, 'self'])->middleware('auth:api');
Route::get('v1/postsown', [UserController::class, 'postsviaauth'])->middleware('auth:api');

Route::get('v1/publishedposts', [PostController::class, 'publishedPostsViaAuth'])->middleware('auth:api');
Route::get('v1/unpublishedposts', [PostController::class, 'unpublishedPostsViaAuth'])->middleware('auth:api');
Route::get('v1/privateposts', [PostController::class, 'privatePostsViaAuth'])->middleware('auth:api');




//test
// Route::get('v1/users', function () {
//     // $user->hasRole('owner');   // false
//     // $user->hasRole('admin');   // true
//     // $user->isAbleTo('edit-user');   // false
//     // $user->isAbleTo('create-post'); // true
//     // $user = App\Models\User::with('roles')->first();
//     // $user = User::whereRoles('administrator')->get(); //select * from `users` where `roles` = administrator
//     // echo $user->hasRole('administrator'); //Column not found: 1054 Unknown column 'roles' in 'where clause' (SQL: select * from `users` where `roles` = administrator)

//     //$email = DB::table('users')->where('name', 'John')->value('email');
//     // echo $role_id;
//     // $user_type = DB::table('role_user')->where('user_id', $user->id)->value('user_type');
//     // echo $user_type;


//     $user = User::all()->first();
//     $role_id = DB::table('role_user')->where('user_id', $user->id)->value('role_id');
//     if($role_id < 3){
//         echo 'admin or super admin';
//     }else{
//         echo 'non admin';
//     }
//     return $user->toArray();
// });