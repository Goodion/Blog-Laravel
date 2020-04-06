<?php

namespace App\Http\Controllers;

use App\Tag;
use Illuminate\Http\Request;

class TagsController extends Controller
{
    public function index(Tag $tag)
    {
        $posts = \Cache::tags(['skillbox_laravel_tags'])->remember('posts_tags|' . $tag->name, 3600*24, function () use ($tag) {
            return $tag->posts()->with('tags')->get();
        });

        $news = \Cache::tags(['skillbox_laravel_tags'])->remember('news_tags|' . $tag->name, 3600*24, function () use ($tag) {
            return $tag->news()->with('tags')->get();
        });

        $tagName = $tag->name;
        return view('tags.taggeddata', compact(['posts', 'news', 'tagName']));
    }
}
