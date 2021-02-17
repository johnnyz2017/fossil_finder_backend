<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Post;

class HelloController extends Controller
{
    public function index(){
        $helloString = 'hello from routes';
        return view('hello', compact('helloString'));
    }
    

    public function posts(){
        // $posts = Post::all();
        // $posts = Post::paginate(8);
        $posts = Post::orderBy('id', 'desc')->paginate(5);
        // dump($posts); //debug on web page
        // return view('hello', compact($posts));
        return view('hello')->withPosts($posts);
    }
}
