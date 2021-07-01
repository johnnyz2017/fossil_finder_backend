<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Post;
use Illuminate\Http\Request;

class PostController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $current_user = auth()->user();
        if(count($current_user->roles) > 0){
            if($current_user->roles[0]->id <= 2){
                // $posts = Post::latest()->paginate(10);
                $posts = Post::with('user')->with('category')->where('private', '=', 'false')->paginate(10);
                $user = auth()->user();
                // $posts = User::all();
                // dd($posts);
                return view('admin.posts.index', compact('posts', 'user'));
            }
        } 
        return view('errors.noauth');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $current_user = auth()->user();
        if(count($current_user->roles) > 0){
            if($current_user->roles[0]->id <= 2){
                //
            }
        } 
        return view('errors.noauth');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $current_user = auth()->user();
        if(count($current_user->roles) > 0){
            if($current_user->roles[0]->id <= 2){
                //
            }
        } 
        return view('errors.noauth');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Post  $post
     * @return \Illuminate\Http\Response
     */
    public function show(Post $post)
    {
        $current_user = auth()->user();
        if(count($current_user->roles) > 0){
            if($current_user->roles[0]->id <= 2){
                //
            }
        } 
        return view('errors.noauth');
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Post  $post
     * @return \Illuminate\Http\Response
     */
    public function edit(Post $post)
    {
        $current_user = auth()->user();
        if(count($current_user->roles) > 0){
            if($current_user->roles[0]->id <= 2){
                //
            }
        } 
        return view('errors.noauth');
    }

    public function publish(Post $post){
        $current_user = auth()->user();
        if(count($current_user->roles) > 0){
            if($current_user->roles[0]->id <= 2){
                $post->published = true;
                $post->save();
                return redirect(route('admin.posts.index'));
            }
        } 
        return view('errors.noauth');
    }

    public function unpublish(Post $post){
        $current_user = auth()->user();
        if(count($current_user->roles) > 0){
            if($current_user->roles[0]->id <= 2){
                $post->published = false;
                $post->save();
                return redirect(route('admin.posts.index'));
            }
        } 
        return view('errors.noauth');
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Post  $post
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Post $post)
    {
        $current_user = auth()->user();
        if(count($current_user->roles) > 0){
            if($current_user->roles[0]->id <= 2){
                //
            }
        } 
        return view('errors.noauth');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Post  $post
     * @return \Illuminate\Http\Response
     */
    public function destroy(Post $post)
    {
        $current_user = auth()->user();
        if(count($current_user->roles) > 0){
            if($current_user->roles[0]->id <= 2){
                $post->delete();
                return redirect(route('admin.posts.index'));
            }
        } 
        return view('errors.noauth');
    }
}
