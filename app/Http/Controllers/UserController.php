<?php


namespace App\Http\Controllers;


class UserController
{
    public function index()
    {
        return view('admin.users.index', ['title' => 'Users', 'users' => \App\User::paginate(5)]);
    }

    public function create()
    {

    }

    public function store()
    {

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
