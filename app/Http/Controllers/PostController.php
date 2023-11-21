<?php

namespace App\Http\Controllers;

use App\Models\Post;
use Illuminate\Http\Request;

class PostController extends Controller
{
    public function index()
    {
        $posts = Post::all(); // Assuming you have a Post model

        return view('pages.home', compact('posts'));
    }

    public function store(Request $request)
{
    $request->validate([
        'post_content' => 'required|string',
    ]);

    $post = new Post();
    $post->post_content = $request->input('post_content');
    $post->user_id = auth()->id();  // Assuming you are associating the post with the authenticated user
    $post->save();

    return redirect()->route('home')->with('success', 'Post created successfully.');
}

}
