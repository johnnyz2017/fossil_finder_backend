<?php

use App\Http\Controllers\api\v1\CategoryController;
use App\Http\Controllers\api\v1\CommentController;
use App\Http\Controllers\api\v1\FSeriesController;
use App\Http\Controllers\api\v1\FStageController;
use App\Http\Controllers\api\v1\FSystemController;
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

Route::get('v1/testauth', [LoginController::class, 'testauth'])->middleware('auth:api');

// Route::apiResource('v1/posts', PostController::class); //OK
Route::get('v1/posts', [PostController::class, 'index'])->middleware('auth:api');
Route::get('v1/posts/{id}', [PostController::class, 'show'])->middleware('auth:api');
Route::post('v1/posts', [PostController::class, 'store'])->middleware('auth:api');
Route::post('v1/posts/{id}', [PostController::class, 'update'])->middleware('auth:api');
Route::delete('v1/posts/{id}', [PostController::class, 'destroy'])->middleware('auth:api');

Route::get('v1/posts/{id}/category', [PostController::class, 'category']);
Route::get('v1/posts/{id}/user', [PostController::class, 'user']);
Route::get('v1/search', [PostController::class, 'search']);

Route::get('v1/categories/{id}/childs', [CategoryController::class, 'childs']);
Route::get('v1/categories/posts', [CategoryController::class, 'posts']);
Route::get('v1/categories/hi', [CategoryController::class, 'hi']);
Route::get('v1/categories/allwithposts', [CategoryController::class, 'allWithPosts']);
Route::get('v1/categories/allwithoutposts', [CategoryController::class, 'allWithoutPosts']);
Route::get('v1/categories', [CategoryController::class, 'index']);
Route::get('v1/categories/{id}', [CategoryController::class, 'show']);
Route::post('v1/categories', [CategoryController::class, 'store'])->middleware('auth:api');
Route::post('v1/categories/{id}', [CategoryController::class, 'update'])->middleware('auth:api');
Route::delete('v1/categories/{id}', [CategoryController::class, 'destroy'])->middleware('auth:api');
Route::get('v1/categories/{id}/posts', [CategoryController::class, 'showPost']);
Route::get('v1/categories/{id}/user', [CategoryController::class, 'user']);
Route::get('v1/categories/{id}/editable', [CategoryController::class, 'editable'])->middleware('auth:api');
Route::get('v1/categories/{id}/deleteable', [CategoryController::class, 'deleteable'])->middleware('auth:api');

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
Route::post('v1/users/{id}', [UserController::class, 'update'])->middleware('auth:api');
Route::post('v1/changepw', [UserController::class, 'changePassword'])->middleware('auth:api');

Route::get('v1/publishedposts', [PostController::class, 'publishedPostsViaAuth'])->middleware('auth:api');
Route::get('v1/unpublishedposts', [PostController::class, 'unpublishedPostsViaAuth'])->middleware('auth:api');
Route::get('v1/privateposts', [PostController::class, 'privatePostsViaAuth'])->middleware('auth:api');

Route::get('v1/system', [FSystemController::class, 'index']);
Route::get('v1/system/{id}', [FSystemController::class, 'show']);
Route::get('v1/system/{id}/series', [FSystemController::class, 'series']);
Route::get('v1/series/{id}', [FSeriesController::class, 'show']);
Route::get('v1/series/{id}/stages', [FSeriesController::class, 'stages']);
Route::get('v1/stage/{id}', [FStageController::class, 'show']);