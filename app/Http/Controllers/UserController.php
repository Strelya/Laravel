<?php


namespace App\Http\Controllers;


use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;

class UserController
{
    public function index()
    {
        return view('admin.users.index', ['title' => 'Users', 'users' => User::paginate(5)]);
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
            'password' => 'required|min:8|confirmed',
            'password_confirmation' => 'required|min:8',
        ]);

        $user = new User;
        $user->name = $request->get('name');
        $user->email = $request->get('email');
        $user->email_verified_at = (new \DateTime)->format('Y-m-d H:i:s');
        $user->password = Hash::make($request->get('password'));
        $user->remember_token = Str::random(10);

        $user->save();

        return redirect()->route("users.index");
    }

    public function show(User $user)
    {

    }

    public function edit(User $user)
    {

    }

    public function update(User $user)
    {

    }

    public function destroy(User $user)
    {
        $user->delete();

        return redirect()->route("users.index")
            ->with('message', 'User ' . $user->name . ' was deleted');
    }
}
