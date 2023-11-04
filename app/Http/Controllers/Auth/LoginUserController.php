<?php

namespace App\Http\Controllers\Auth;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;

class LoginUserController extends Controller
{
    public function loginPage()
{
    return view('auth.login');
}

public function login(Request $request)
{
    // Validate the user input
    $credentials = $request->validate([
        'email' => 'required|email',
        'password' => 'required',
    ]);

    // Attempt to log in the user
    if (Auth::attempt($credentials)) {
        // Authentication passed, redirect to the intended page or a default page
        return redirect()->intended('/home');
    }

    // Authentication failed, return with an error message
    return back()->withErrors(['email' => 'Invalid login credentials']);
}

public function logout()
{
    Auth::logout();
    return redirect('/login');
}


}
