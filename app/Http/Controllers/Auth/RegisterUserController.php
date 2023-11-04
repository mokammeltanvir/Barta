<?php

namespace App\Http\Controllers\Auth;

use App\Models\User;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class RegisterUserController extends Controller
{
    // Display the registration form
    public function create()
    {
        return view('auth.register');
    }

    // Handle the registration form submission
    public function store(Request $request)
    {
        // Validate user input
        $request->validate([
            'fname' => 'required|string|max:255',
            'lname' => 'nullable|string|max:255',
            'username' => 'required|string|max:32|unique:users',
            'email' => 'required|email|unique:users',
            'password' => 'required|string|min:6',
        ]);

        // Create a new user
        $user = new User();
        $user->fname = $request->input('fname');
        $user->lname = $request->input('lname');
        $user->username = $request->input('username');
        $user->email = $request->input('email');
        $user->password = Hash::make($request->input('password'));
        $user->save();

        // Log in the newly registered user
        auth()->login($user);

        return redirect('/home')->with('success', 'Registration successful');
    }
}
