<?php

namespace App\Http\Controllers;

use App\Models\Post;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    public function index()
    {
        // Get posts of the authenticated user
    $userPosts = auth()->user()->posts;

    // Get posts of other users
    $otherUsersPosts = Post::where('user_id', '!=', auth()->id())->latest()->get();

    // Merge and order posts
    $posts = $userPosts->merge($otherUsersPosts)->sortByDesc('created_at');

    return view('pages.home.index', compact('posts'));
    }

    public function store(Request $request)
    {
        // Validate the post content
        $request->validate([
            'post_content' => 'required|string',
        ]);

        // Create a new post for the authenticated user
        auth()->user()->posts()->create($request->only('post_content'));

        // Redirect back to the HomePage
        return redirect()->route('home');
    }
}
