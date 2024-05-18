<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Comment;

class CommentController extends Controller
{
    public function store(Request $request)
    {
        $request->validate([
            'post_id' => 'required|exists:posts,id',
            'content' => 'required|string|max:255',
        ]);
        $comment = new Comment([
            'post_id' =>$request->post_id,
            'content' =>$request->content,
        ]);

        $comment->save();

        return redirect()->back()->with('success','Comment added successfully.');
    }
}
