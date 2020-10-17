<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Category;

class TreeViewController extends Controller
{
    public function treeView(){       
        $Categorys = Category::where('parent_id', '=', 0)->get();
        $tree='<ul id="browser" class="filetree"><li class="tree-view"></li>';
        foreach ($Categorys as $Category) {
             $tree .='<li class="tree-view closed"<a class="tree-name">'.$Category->title.'</a>';
             if(count($Category->childs)) {
                $tree .=$this->childView($Category);
            }
        }
        $tree .='<ul>';
        return view('categories.treeview',compact('tree'));
    }
    public function childView($Category){                 
            $html ='<ul>';
            foreach ($Category->childs as $arr) {
                if(count($arr->childs)){
                $html .='<li class="tree-view closed"><a class="tree-name">'.$arr->title.'</a>';                  
                        $html.= $this->childView($arr);
                    }else{
                        $html .='<li class="tree-view"><a class="tree-name">'.$arr->title.'</a>';                                 
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
