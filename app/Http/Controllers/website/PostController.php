<?php

namespace App\Http\Controllers\website;

use App\Http\Controllers\Controller;
use App\Models\Comment;
use App\Models\Post;
use Illuminate\Http\Request;

class PostController extends Controller
{
    public function index(Post $post)
    {
        // Check if this post has already been visited in the current session
        $visited = session()->get('visited_posts', []);

        // Check if the current post id is not in the visited array
        if (!in_array($post->id, $visited)) {
            // Increment the visits count
            $post->visitors++;
            $post->save();

            // Add post id to the visited array
            $visited[] = $post->id;
            session()->put('visited_posts', $visited);
        }

        $post->visits++;
        $post->save();
        
        $commentsCount = $post->comments()->count();
        $comments = Comment::where('post_id', $post->id)->get();
        return view('website.post', compact('post', 'commentsCount', 'comments'));
    }
}
