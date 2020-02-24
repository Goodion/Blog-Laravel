<?php

namespace App\Http\Controllers;

use App\Post;

class PostsController extends Controller
{
    public function index()
    {
        $posts = Post::latest()->get();
        $title = 'Главная';
        return view('index', compact('posts', 'title'));
    }

    public function show(Post $post)
    {
        $title = $post->slug;
        return view('posts.show', compact('post', 'title'));
    }

    public function create()
    {
        $title = 'Создание статьи';
        return view('posts.create', compact('title'));
    }

    public function store()
    {
        $published = request('published') === 'on' ? true : false;

        $this->validate(request(), [
            'title' => 'required|between:5,100',
            'body' => 'required',
            'slug' => 'required|alpha_dash|unique:posts,slug',
            'description' => 'required|max:255',
        ]);

        Post::create([
            'title' => request('title'),
            'body' => request('body'),
            'slug' => request('slug'),
            'description' => request('description'),
            'files' => null,
            'published' => $published,
        ]);

        return redirect('/');
    }
}
