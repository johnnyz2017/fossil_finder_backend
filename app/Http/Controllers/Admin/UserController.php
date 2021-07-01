<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Role;
use App\Models\User;
use Illuminate\Http\Request;
use App\Http\Requests\CreateUserRequest;

class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $roles = Role::with('permissions')->get();
        $users = User::latest()->paginate(10);
        $current_user = auth()->user();
        if(count($current_user->roles) > 0){
            if($current_user->roles[0]->id < 2){
                return view('admin.users.index', compact('users', 'roles', 'current_user'));
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
            if($current_user->roles[0]->id < 2){
                $roles = Role::with('permissions')->latest()->get();
                return view('admin.users.create', compact('roles'));
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
    public function store(CreateUserRequest $request)
    {
        $current_user = auth()->user();
        if(count($current_user->roles) > 0){
            if($current_user->roles[0]->id < 2){
                $user = User::create([
                    'name' => $request->name,
                    'email' => $request->email,
                    // 'password' => Hash::make($request->password),
                    'password' => bcrypt($request->password),
                ]);
        
                $role = Role::find($request->role);
                $user->attachRole($role);
        
                return redirect(route('admin.users.index'));
            }
        } 
        return view('errors.noauth');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\User  $user
     * @return \Illuminate\Http\Response
     */
    public function show(User $user)
    {
        $current_user = auth()->user();
        if(count($current_user->roles) > 0){
            if($current_user->roles[0]->id < 2){
                return view('admin.users.show', compact('user'));
            }
        } 
        return view('errors.noauth');
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\User  $user
     * @return \Illuminate\Http\Response
     */
    public function edit(User $user)
    {
        $current_user = auth()->user();
        if(count($current_user->roles) > 0){
            if($current_user->roles[0]->id < 2){
                $roles = Role::with('permissions')->get();
                return view('admin.users.edit', compact('user', 'roles'));
            }
        } 
        return view('errors.noauth');
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\User  $user
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, User $user)
    {
        $current_user = auth()->user();
        if(count($current_user->roles) > 0){
            if($current_user->roles[0]->id < 2){
                if($request->password == null)
                {
                    $user->update([
                        'name' => $request->name,
                    ]);
                }else{
                    $user->update([
                        'name' => $request->name,
                        'password' => bcrypt($request->password)
                    ]);
                }
                
        
                $roles = $user->roles;
        
                foreach ($roles as $key => $value) {
                    $user->detachRole($value);
                }
        
                $role = Role::find($request->input('role'));
                $user->attachRole($role);
        
                return redirect(route('admin.users.index'));
            }
        } 
        return view('errors.noauth');
        
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\User  $user
     * @return \Illuminate\Http\Response
     */
    public function destroy(User $user)
    {
        $current_user = auth()->user();
        if(count($current_user->roles) > 0){
            if($current_user->roles[0]->id < 2){
                $roles = $user->roles;

                foreach ($roles as $key => $value) {
                    $user->detachRole($value);
                }
        
                $user->delete();
                return redirect(route('admin.users.index'));
            }
        } 
        return view('errors.noauth');
    }
}
