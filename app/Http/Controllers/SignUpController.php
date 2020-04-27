<?php


namespace App\Http\Controllers;

use Illuminate\Http\Request;

class SignUpController
{
    public function login()
    {
        return view('login');
    }

    public function register(Request $request)
    {
        $request->validate([
            'email' => 'required|email|unique:users,email',
            'password' => 'required|min:8|confirmed',
            'password_confirmation' => 'required|min:8',
        ]);

        $credentials = $request->only(['email', 'password']);
//        dd($credentials);

        $user = new User;
        list($userName, $rest) = explode('@', $credentials['email']);
        $user->name = ucfirst($userName);
        $user->email = $credentials['email'];
        $user->password = Hash::make($credentials['password']);
        $user->save();

        if (Auth::attempt($credentials)) {
            return redirect()->route('home');
        }
    }
}
