<?php

namespace App\Http\Controllers;

use App\Models\Post;
use Illuminate\Http\Request;

class PostController extends Controller
{
    public function index()
    {
        $posts = Post::latest()->paginate(10);
        return view('pages.posts.index', compact('posts'));
    }

    public function show(Post $post)
    {
        $comments = $post->comments;
        return view('pages.posts.show', compact('post', 'comments'));
    }

    public function create()
    {
        return view('pages.posts.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'post_content' => 'required|string',
        ]);

        auth()->user()->posts()->create([
            'post_content' => $request->input('post_content'),
        ]);

        return redirect()->route('home')->with('success', 'Post created successfully.');
    }

    public function edit(Post $post)
    {
        return view('pages.posts.edit', compact('post'));
    }

    public function update(Request $request, Post $post)
    {
        $request->validate([
            'post_content' => 'required|string',
        ]);

        $post->update([
            'post_content' => $request->input('post_content'),
        ]);

        return redirect()->route('home')->with('success', 'Post updated successfully.');
    }

    public function destroy(Post $post)
    {
        $post->delete();

        return redirect()->route('home')->with('success', 'Post deleted successfully.');
    }
}
