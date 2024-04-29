<?php

namespace App\Providers;

use App\Models\Category;
use App\Models\Post;
use App\Models\Setting;
use Illuminate\Pagination\Paginator;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        //
    }

    /**
     * Bootstrap any application services.
     */
    public function boot()
    {
        Paginator::useBootstrap();
        $setting = Setting::checkSettings();
        $categories = Category::with('children')->where('parent', 0)->get();
        // $lastFivePosts = Post::latest()->take(1)->get();
        $lastFivePosts = Post::orderBy('id', 'desc')->take(5)->get();
        $topPosts = Post::orderBy('visits', 'desc')->take(4)->get();

        view()->share([
            'setting' =>  $setting,
            'categories' => $categories,
            'lastFivePosts' => $lastFivePosts,
            'topPosts' => $topPosts,
        ]);
    }
}
