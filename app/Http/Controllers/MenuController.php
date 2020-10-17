<?php

namespace App\Http\Controllers;

use App\Models\Category;
use Illuminate\Http\Request;

class MenuController extends Controller
{
    public function index(){
        $menus = Category::where('parent_id', '=', 0)->get();
        $allMenus = Category::pluck('title','id')->all();
        return view('menu.menuTreeview',compact('menus','allMenus'));
    }

    public function store(Request $request)
    {
        $request->validate([
           'title' => 'required',
        ]);

        $input = $request->all();
        $input['parent_id'] = empty($input['parent_id']) ? 0 : $input['parent_id'];
        Category::create($input);
        return back()->with('success', 'Menu added successfully.');
    }

    public function show()
    {
        $menus = Category::where('parent_id', '=', 0)->get();
        return view('menu.dynamicMenu',compact('menus'));
    }
}
