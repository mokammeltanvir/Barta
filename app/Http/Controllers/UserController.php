<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\RedirectResponse;
use Intervention\Image\Facades\Image;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Redirect;
use App\Http\Requests\ProfileUpdateRequest;
use Intervention\Image\ImageManager;
use Intervention\Image\Drivers\Gd\Driver;

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
        $user = User::find(auth()->user()->id);
        $this->uploadImage($request, $user->id);

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

        return redirect()->route('user.show', ['user' => auth()->user()->id])->with('status', 'profile-updated');
    }

    /**
     * Update the user's profile avatar.
     */
    public function uploadImage($request, $user_id)
    {
        // Check if an image is uploaded
        if ($request->file('user_image')) {
            $user = User::find($user_id);

            $manager = new ImageManager(new Driver());
            $new_photo_name = hexdec(uniqid()) . '.' . $request->user_image->extension();
            $img = $manager->read($request->file('user_image'));
            $img =$img->resize(250, 250);

            $img->toJpeg(80)->save(public_path('uploads/avatar/' . $new_photo_name));
            // $save_path = 'upload/avatar/' . $new_photo_name;

            $user->user_image = $new_photo_name;
            $user->save();

        }

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

    /**
     * Display the user's profile form.
     */
    public function search(Request $request, $id)
{
    $user = User::findOrFail($id);

    // Check if a search query is provided
    $search = $request->query('search');

    // If search query exists, filter users based on name, last name, or email
    if ($search) {
        $users = User::where('fname', 'like', '%' . $search . '%')
            ->orWhere('lname', 'like', '%' . $search . '%')
            ->orWhere('email', 'like', '%' . $search . '%')
            ->get();
    } else {
        $users = collect(); // an empty collection if no search term is provided
    }

    return view('search.profile', compact('user', 'users', 'search'));
}


}
