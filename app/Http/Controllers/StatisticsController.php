<?php

namespace App\Http\Controllers;

use App\News;
use App\Post;
use Illuminate\Http\Request;

class StatisticsController extends Controller
{
    public function index()
    {
        $statistics = \Cache::tags(['skillbox_laravel_posts', 'skillbox_laravel_news', 'skillbox_laravel_tags', 'skillbox_laravel_comments'])->remember('statistics', 3600*24, function () {
            return collect([
                'overallPosts' => Post::count(),
                'overallNews' => News::count(),
                'userWithMaxPosts' => \DB::table('posts')
                    ->select(\DB::raw('count(*) as total'), 'users.name')
                    ->groupBy('author_id')
                    ->join('users', 'posts.author_id', '=', 'users.id')
                    ->orderBy('total', 'desc')
                    ->first(),
                'longestPost'=> \DB::table('posts')
                    ->select(\DB::raw('LENGTH(body) as length'), 'title', 'slug' )
                    ->groupBy('id')
                    ->orderBy('length', 'desc')
                    ->first(),
                'shortestPost' => \DB::table('posts')
                    ->select(\DB::raw('LENGTH(body) as length'), 'title', 'slug' )
                    ->groupBy('id')
                    ->orderBy('length', 'asc')
                    ->first(),
                'averagePosts'=> \DB::table('posts')
                    ->select(\DB::raw('count(*) as total'))
                    ->groupBy('author_id')
                    ->havingRaw('COUNT(*) > 1')
                    ->get()
                    ->avg('total'),
                'oftenUpdatedPost' => \DB::table('post_histories')
                    ->select(\DB::raw('count(*) as total'), 'title', 'slug')
                    ->groupBy('post_id')
                    ->orderBy('total', 'desc')
                    ->leftJoin('posts', 'post_histories.post_id', '=', 'posts.id')
                    ->first(),
                'postWithMostNews'=> \DB::table('comments')
                    ->select(\DB::raw('count(*) as total'), 'title', 'slug')
                    ->where('commentable_type', '=', 'App\Post')
                    ->groupBy('commentable_id')
                    ->orderBy('total', 'desc')
                    ->leftJoin('posts', 'comments.commentable_id', '=', 'posts.id')
                    ->first(),
            ]);
        });

        return view('statistics', compact('statistics'));
    }
}
