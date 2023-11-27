<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Facades\Redirect;
use App\Http\Requests\ProfileUpdateRequest;

class UserController extends Controller
{
    /**
     * Display the user's profile form.
     */
    public function show(User $user)
    {
        $posts = $user->posts()->with('user')->get();
        return view('profile.show', compact('user', 'posts'));
    }

    /**
     * Display the user's profile form.
     */
    public function edit(Request $request)
    {
        return view('profile.edit', [
            'user' => $request->user(),
        ]);
    }

    /**
     * Update the user's profile information.
     */

    public function update(ProfileUpdateRequest $request): RedirectResponse
{
    $user = $request->user();

    $data = [
        'fname' => $request->input('fname'),
        'lname' => $request->input('lname'),
        'email' => $request->input('email'),
        'bio' => $request->input('bio'),
    ];

    // Update password if provided, otherwise use the existing password
    if ($password = $request->input('password')) {
        $data['password'] = bcrypt($password);
    }

    $user->update($data);

    // dd($user);
    return redirect()->route('user.show', ['user' => auth()->user()->id])->with('status', 'profile-updated');

}

    /**
     * Delete the user's account.
     */
    public function destroy(Request $request): RedirectResponse
    {
        $request->validateWithBag('userDeletion', [
            'password' => ['required', 'current_password'],
        ]);

        $user = $request->user();

        Auth::logout();

        $user->delete();

        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return Redirect::to('/');
    }
}
