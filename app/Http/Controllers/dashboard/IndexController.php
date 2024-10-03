<?php

namespace App\Http\Controllers\dashboard;

use App\Http\Controllers\Controller;
use App\Models\Category;
use App\Models\Post;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Http\Request;

class IndexController extends Controller
{

    public function index()
    {

        $visits = Post::sum('visits');
        $posts = Post::count();
        $users = User::where('status', 'user')->count();

        //====================================================== 
        //====================================================== 

        // Calculate percentage increase or decrease in visits

        // Get the current month's total visits
        // Carbon::now()->subDays(30);
        // Carbon::now();
        $currentMonthVisits = Post::whereBetween('created_at', [Carbon::now()->startOfMonth(), Carbon::now()->endOfMonth()])
        ->sum('visits');
    
        // Get the previous month's total visits
        // Carbon::now()->subDays(60);
        // Carbon::now()->subDays(31);
        $previousMonthVisits = Post::whereBetween('created_at', [Carbon::now()->subMonth()->startOfMonth(), Carbon::now()->subMonth()->endOfMonth()])
        ->sum('visits');


        

        if ($previousMonthVisits > 0) {
            $percent_from = $currentMonthVisits - $previousMonthVisits;
            $visitPercent = $percent_from / $previousMonthVisits * 100;
        } else {
            $visitPercent = $currentMonthVisits > 0 ? 100 : 0; 
        }

        //====================================================== 
        //====================================================== 
        
        // Calculate percentage increase or decrease in posts
        $currentMonthPosts = Post::whereBetween('created_at', [Carbon::now()->startOfMonth(), Carbon::now()->endOfMonth()])
        ->count();

        $previousMonthPosts = Post::whereBetween('created_at', [Carbon::now()->subMonth()->startOfMonth(), Carbon::now()->subMonth()->endOfMonth()])
        ->count();
        
        if ($previousMonthPosts > 0) {
            $percent_from = $currentMonthPosts - $previousMonthPosts;
            $postsPercent = $percent_from / $previousMonthPosts * 100;
        } else {
            $postsPercent = $currentMonthPosts > 0 ? 100 : 0; 
        }

        //====================================================== 
        //====================================================== 
        
        // Calculate percentage increase or decrease in posts
        $currentMonthUsers = User::whereBetween('created_at', [Carbon::now()->startOfMonth(), Carbon::now()->endOfMonth()])->where('status', 'user')
        ->count();

        $previousMonthUsers = User::whereBetween('created_at', [Carbon::now()->subMonth()->startOfMonth(), Carbon::now()->subMonth()->endOfMonth()])->where('status', 'user')
        ->count();

        if ($previousMonthUsers > 0) {
            $percent_from = $currentMonthUsers - $previousMonthUsers; 
            $usersPercent = ($percent_from / $previousMonthUsers) * 100; 
        } else {
            $usersPercent = $currentMonthUsers > 0 ? 100 : 0; 
        }

        // ===================================================
        // ===================================================
        
        $categoryVisits = Post::with('category')->select('category_id')
        ->selectRaw('SUM(visits) as total_visits')
        ->groupBy('category_id')
        ->orderBy('total_visits', 'DESC')
        ->take(3)
        ->get();


        $labels = $categoryVisits->map(function ($item) {
            return $item->category ? $item->category->title : 'Unknown'; // Assuming 'name' is the field for the category's name
        })->all();
        $data = $categoryVisits->pluck('total_visits')->all(); // Getting total visits for data

        $pie = app()->chartjs
            ->name('pieChartTest')
            ->type('pie')
            ->size(['width' => 400, 'height' => 200])
            ->labels($labels)
            ->datasets([
                [
                    'backgroundColor' => ['#A3B763', '#FF407D', '#7071E8'],
                    // 'hoverBackgroundColor' => ['#A3B763', '#FF407D', '#7071E8'],
                    'data' => $data,
                ]
            ])
            ->options([]);

        $bar = app()->chartjs
         ->name('barChartTest')
         ->type('bar')
         ->size(['width' => 300, 'height' => 200])
         ->labels($labels)
         ->datasets([
             [
                 "label" => __('words.label'),
                 'backgroundColor' => ['#A3B763', '#FF407D', '#7071E8'],
                 'data' => $data,
             ],
         ])
         ->options([
            "scales" => [
                "yAxes" => [[
                    "ticks" => [
                        "beginAtZero" => true,
                        // "stepSize" => 5
                    ]
                ]]
            ]
        ]);

        return view('dashboard.index', compact('visits', 
                                                'posts', 
                                                'users', 
                                                'visitPercent',
                                                'postsPercent',
                                                'usersPercent', 
                                                'previousMonthVisits', 
                                                'previousMonthPosts', 
                                                'previousMonthUsers', 
                                                'pie', 
                                                'bar'
                                                ));
    }
}
