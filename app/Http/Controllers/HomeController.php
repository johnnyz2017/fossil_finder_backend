<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Category;
use App\Models\Post;
use App\Models\User;
use Illuminate\Support\Facades\Auth;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        // $this->middleware('auth'); //when needed
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        $Categorys = Category::where('parent_id', '=', 0)->get();
        $tree='<ul id="browser" class="filetree"><li class="tree-view"></li>';
        foreach ($Categorys as $Category) {
            if($Category->is_genus == 1){
                $tree .='<li class="tree-view open"><em><a class="tree-name">'.$Category->title.'</a></em>';
            }
            else{
                $tree .='<li class="tree-view open"><a class="tree-name">'.$Category->title.'</a>';
            }
            
            if(count($Category->childs)) {
                $tree .=$this->childView($Category);
            }
        }
        $tree .='<ul>';

        $posts = Post::all();

        $user = null;

        if(Auth::check()){
            // $user_id = auth()->user()->id;
            // $user = User::find($user_id)->with('role');
            $user = auth()->user();
        }

        return view('home',compact('tree', 'posts', 'user'));
    }

    public function childView($Category){                 
        $html ='<ul>';
        foreach ($Category->childs as $arr) {
            if(count($arr->childs)){
                if($arr->is_genus == 1){
                    $html .='<li class="tree-view closed"><em><a class="tree-name">'.$arr->title.'</a></em>';
                }
                else{
                    $html .='<li class="tree-view closed"><a class="tree-name">'.$arr->title.'</a>';                  
                }
                $html.= $this->childView($arr);
            }else{
                if($arr->is_genus == 1){
                    $html .='<li class="tree-view"><em><a class="tree-name">'.$arr->title.'</a></em>';
                }
                else{
                    $html .='<li class="tree-view"><a class="tree-name">'.$arr->title.'</a>';                  
                }                            
                $html .="</li>";
            }                                   
        }
        
        $html .="</ul>";
        return $html;
    }   



    public function manageCategory()
    {
        $categories = Category::where('parent_id', '=', 0)->get();
        $allCategories = Category::pluck('title','id')->all();
        return view('categories.categoryTreeview',compact('categories','allCategories'));
    }

    public function addCategory(Request $request)
    {
        $this->validate($request, [
                'title' => 'required',
            ]);
        $input = $request->all();
        $input['parent_id'] = empty($input['parent_id']) ? 0 : $input['parent_id'];
        
        Category::create($input);
        return back()->with('success', 'New Category added successfully.');
    }
}
