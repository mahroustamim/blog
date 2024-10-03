<?php

namespace App\Http\Controllers\website;

use App\Http\Controllers\Controller;
use App\Models\Category;
use App\Models\Post;
use App\Models\PostTranslation;
use Illuminate\Http\Request;

class IndexController extends Controller
{
    public function index() 
    {
        $categoriesWithPosts = Category::with(['posts' => function($query) {
            $query->latest()->limit(4);
        }])->get();
        // return view('website.index', compact('categoriesWithPosts'));
        return view('website.index', compact('categoriesWithPosts'));
    }

    public function about()
    {
        return view('website.aboutUs');
    }

    public function search(Request $request)
    {

        $value = $request->search;


        $posts = Post::query()
        ->join('post_translations', 'posts.id', '=', 'post_translations.post_id')
        ->where('post_translations.locale', app()->getLocale()) // Ensure you're querying the correct language
        ->where(function($query) use ($value) {
            $query->where('post_translations.title', 'LIKE', "%{$value}%")
                  ->orWhere('post_translations.content', 'LIKE', "%{$value}%");
        })
        ->select('posts.*') // Make sure to select posts fields only to avoid conflicts
        ->distinct() // Optional: ensure unique posts if your data can have duplicates
        ->paginate(10);

        $false = '';
        if ($posts->count() > 0) {
            return view('website.search', compact('posts'));
        } else {
            return view('website.search', compact('false', 'posts'));
        }

    }

}
