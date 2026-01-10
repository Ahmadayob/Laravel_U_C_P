<?php


namespace App\Http\Controllers;

use App\Models\Post;
use App\Models\User;
use App\Models\Comment;
use Illuminate\Http\Request;

class IndexController extends Controller
{
    public function __invoke(Request $request)
    {
        // Get statistics
        $stats = [
            'total_posts' => Post::count(),
            'total_users' => User::count(),
            'total_comments' => Comment::count(),
            'published_posts' => Post::where('published', true)->count(),
        ];

        // Get recent posts
        $recentPosts = Post::with('user')
            ->latest()
            ->take(5)
            ->get();

        // Get user-specific stats if authenticated
        $userStats = null;
        if (auth()->check()) {
            $userStats = [
                'my_posts' => Post::where('user_id', auth()->id())->count(),
                'my_comments' => Comment::where('user_id', auth()->id())->count(),
            ];
        }

        return view('index', [
            'title' => 'Dashboard',
            'stats' => $stats,
            'recentPosts' => $recentPosts,
            'userStats' => $userStats,
        ]);
    }
}

