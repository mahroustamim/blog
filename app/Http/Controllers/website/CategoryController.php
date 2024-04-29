<?php

namespace App\Http\Controllers\website;

use App\Http\Controllers\Controller;
use App\Models\Category;
use App\Models\Post;
use Illuminate\Http\Request;

class CategoryController extends Controller
{
    public function index(Category $category)
    {
        $posts = Post::where('category_id', $category->id)->paginate(10);
        return view('website.category', compact('category', 'posts'));
    }
}
