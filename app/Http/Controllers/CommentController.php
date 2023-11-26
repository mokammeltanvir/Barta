<?php

namespace App\Http\Controllers;

use App\Models\Comment;
use Illuminate\Http\Request;

class CommentController extends Controller
{
    public function store(Request $request)
    {
        $request->validate([
            'content' => 'required|string',
            'post_id' => 'required|exists:posts,id',
        ]);

        Comment::create([
            'content' => $request->input('content'),
            'user_id' => auth()->id(),
            'post_id' => $request->input('post_id'),
        ]);

        return back(); // Redirect back to the post after commenting
    }

    public function destroy(Comment $comment)
    {
        // Check if the authenticated user is the owner of the comment
        if (auth()->user()->id === $comment->user_id) {
            $comment->delete();
        }

        return back(); // Redirect back to the post after deleting the comment
    }
}
