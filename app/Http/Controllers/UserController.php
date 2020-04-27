<?php


namespace App\Http\Controllers;


use Illuminate\Http\Request;

class UserController
{
    public function index()
    {
        return view('admin.users.index', ['title' => 'Users', 'users' => \App\User::paginate(5)]);
    }

    public function create()
    {
        return view('admin.users.create', ['title' => 'Create User']);
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required',
            'email' => 'required|email|unique:users,email',
            'password' => 'required|min:8',
            'password_confirmation' => 'required|min:8|confirmed',
        ]);

        $user = new User;
        $user->name = $request->get('name');
        $user->email = $request->get('email');
        $user->email_verified_at = new \DateTime()-format('Y-m-d H:i:s');
        $user->password = Hash::make($request->get('password'));

        $user->save();
    }

    public function show(\App\User $user)
    {

    }

    public function edit(\App\User $user)
    {

    }

    public function update(\App\User $user)
    {

    }

    public function destroy(\App\User $user)
    {

    }
}
