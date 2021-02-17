<?php

use App\Http\Controllers\HelloController;
use App\Http\Controllers\MenuController;
use App\Http\Controllers\PostController;
use App\Http\Controllers\UserController;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', function () {
    return view('pages.home');
});

Route::get('/welcome', function () {
    return view('welcome');
});

Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');

Route::get('/tree', [App\Http\Controllers\TreeViewController::class, 'treeView']);

Route::get('category-tree-view', [App\Http\Controllers\TreeViewController::class, 'manageCategory']);
Route::post('add-category', [App\Http\Controllers\TreeViewController::class, 'addCategory'])->name('add.category');

Route::get('menus', [MenuController::class, 'index']);
Route::get('menus-show', [MenuController::class, 'show']);
Route::post('menus', [MenuController::class, 'store'])->name('menus.store');

// Route::get('/hello', function(){
//     // return 'Hello';

//     $helloString = 'hello from routes';
//     return view('hello', compact('helloString'));
// });
Route::get('/hello', [HelloController::class, 'posts']);

Route::resource('posts', PostController::class);
Route::resource('users', UserController::class);
// Route::resource([
//     'users' => UserController::class,
//     'posts' => PostController::class
// ]);