<?php

namespace App\Http\Controllers\website;

use App\Http\Controllers\Controller;
use App\Models\Comment;
use Illuminate\Http\Request;

class CommentController extends Controller
{
    public function store(Request $request, $id)
    {
        $request->validate([
            'comment' => 'required',
        ]);

        Comment::create([
            'comment' => $request->comment,
            'user_id' => auth()->user()->id,
            'post_id' => $id
        ]);
        return redirect()->back();
    }
    
    public function delete(Comment $comment)
    {
        $comment->delete();
        return redirect()->back();
    }
}
