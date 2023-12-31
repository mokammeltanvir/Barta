<?php

namespace App\Http\Controllers;

use App\Models\Post;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Intervention\Image\ImageManager;
use Intervention\Image\Drivers\Gd\Driver;
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
        if ($request->file('post_image')) {
            $post = Post::find($post_id);

            $manager = new ImageManager(new Driver());
            $new_photo_name = hexdec(uniqid()) . '.' . $request->post_image->extension();
            $img = $manager->read($request->file('post_image'));
            $img =$img->resize(350, 250);

            $img->toJpeg(80)->save(public_path('uploads/posts/' . $new_photo_name));
            // $save_path = 'upload/avatar/' . $new_photo_name;

            $post->post_image = $new_photo_name;
            $post->save();

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
