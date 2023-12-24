<?php

namespace App\Http\Controllers;

use App\Models\Post;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

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
            'post_image' => 'image|mimes:jpeg,png,jpg,gif,svg|max:2048',
        ]);

        $post = auth()->user()->posts()->create([
            'post_content' => $request->input('post_content'),
        ]);

        $this->uploadImage($request, $post->id);

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
            'post_image' => 'image|mimes:jpeg,png,jpg,gif,svg|max:2048',
        ]);

        $post->update([
            'post_content' => $request->input('post_content'),
        ]);

        $this->uploadImage($request, $post->id);

        return redirect()->route('home')->with('success', 'Post updated successfully.');
    }

    public function uploadImage($request, $post_id)
    {
        // Check if an image is uploaded
        if ($request->hasFile('post_image')) {
            $post = Post::find($post_id);

            // Check if the post already has a previous image
            if ($post->post_image !== null) {
                // Delete the old photo using Laravel's file storage
                Storage::delete('public/uploads/posts/' . $post->post_image);
            }

            $photo_location = 'public/uploads/posts/';
            $uploaded_photo = $request->file('post_image');
            $new_photo_name = $post_id . '.' . $uploaded_photo->getClientOriginalExtension();
            $new_photo_location = $photo_location . $new_photo_name;

            // Save image using Laravel's file storage
            Storage::putFileAs('public/uploads/posts/', $uploaded_photo, $new_photo_name);

            $post->update([
                'post_image' => $new_photo_name,
            ]);
        }
    }

    public function destroy(Post $post)
    {
        // Delete the post image
        if ($post->post_image !== null) {
            Storage::delete('public/uploads/posts/' . $post->post_image);
        }

        $post->delete();

        return redirect()->route('home')->with('success', 'Post deleted successfully.');
    }
}
