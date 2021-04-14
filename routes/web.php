<?php

use App\Admin\Controllers\PostController as ControllersPostController;
use App\Http\Controllers\Admin\UserController as AdminUserController;
use App\Http\Controllers\HelloController;
use App\Http\Controllers\MenuController;
use App\Http\Controllers\PostController;
use App\Http\Controllers\UserController;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth;
use App\Models\Category;

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

// Route::get('/', function () {
//     return view('home');
// });
Route::get('/', [App\Http\Controllers\HomeController::class, 'index']);

Route::get('/index', [App\Http\Controllers\TreeViewController::class, 'index']);

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



Route::group(['middleware' => ['auth']], function () {
	Route::name('admin.')->group(function() {
		Route::group(['prefix' => 'admin'], function() {
			// Route::get('/', 'Admin\BoardController@index')->name('board');
			Route::resource('users', App\Http\Controllers\Admin\UserController::class);
			Route::resource('posts', App\Http\Controllers\Admin\PostController::class);
			// Route::resource('roles', 'Admin\RoleController');
			// Route::resource('permissions', 'Admin\PermissionController');
		});
	});
});