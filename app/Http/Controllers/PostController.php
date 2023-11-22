<?php

namespace App\Http\Controllers;

use App\Models\Post;
use Illuminate\Http\Request;

class PostController extends Controller
{
    public function index()
    {
        // $posts = Post::all();
        $posts = Post::with('user')->get();

        return view('home', compact('posts'));
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

public function edit(Post $post)
{
    // Show the edit form
    return view('pages.posts.edit', compact('post'));
}

public function update(Request $request, Post $post)
{
    // Validate the request
    $request->validate([
        'post_content' => 'required|string',
    ]);

    // Update the post
    $post->update([
        'post_content' => $request->input('post_content'),
    ]);

    return redirect()->route('home')->with('success', 'Post updated successfully.');
}

public function destroy(Post $post)
{
    // Delete the post
    $post->delete();

    return redirect()->route('home')->with('success', 'Post deleted successfully.');
}

}
