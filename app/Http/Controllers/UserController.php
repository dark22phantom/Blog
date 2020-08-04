<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\User;
use App\Role;
use Session;

class UserController extends Controller
{
    public function index(){
        $users = User::all();

        return view('admin.users.index', ['users'=>$users]);
    }

    public function create(){
        return view('admin.users.create');
    }

    public function store(User $user){
        $inputs = request()->validate([
            'username' => ['required','string','max:255','alpha_dash'],
            'name' => ['required','string','max:255'],
            'email' => ['required','email','max:255'],
            'avatar' => ['mimes:jpeg,png'],
            'password' => ['min:5','max:255','confirmed']
        ]);

        if(request('avatar')){
            $inputs['avatar'] = request('avatar')->store('images');
        }

        $user->create($inputs);

        return redirect()->route('users.index');
    }

    public function show(User $user){
        $roles = Role::all();
        return view('admin.users.profile',[
            'user' => $user,
            'roles' => $roles
        ]);
    }

    public function update(User $user){
        $inputs = request()->validate([
            'username' => ['required','string','max:255','alpha_dash'],
            'name' => ['required','string','max:255'],
            'email' => ['required','email','max:255'],
            'avatar' => ['mimes:jpeg,png'],
            'password' => ['min:5','max:255','confirmed']
        ]);

        // $messages = [
        //     'required' => 'The :attribute field is required.',
        //     'mimes' => 'Only jpeg & png are allowed.'
        // ];

        if(request('avatar')){
            $inputs['avatar'] = request('avatar')->store('images');
        }

        $user->update($inputs);

        return back();
    }

    public function destroy(User $user){
        $user->delete();
        Session::flash('alert-deleted', 'User has been deleted');

        return back();
    }

    public function attach(User $user){
        $role_id = request('role');
        $user->roles()->attach($role_id);

        return back();
    }

    public function detach(User $user){
        $role_id = request('role');
        $user->roles()->detach($role_id);

        return back();
    }
}
