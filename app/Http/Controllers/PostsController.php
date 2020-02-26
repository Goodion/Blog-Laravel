<?php

namespace App\Http\Controllers;

use App\Post;

class PostsController extends Controller
{
    public function index()
    {
        $posts = Post::latest()->get();
        return view('index', compact('posts'));
    }

    public function show(Post $post)
    {
        return view('posts.show', compact('post'));
    }

    public function create()
    {
        return view('posts.create');
    }

    public function store()
    {
        $published = request('published') === 'on' ? true : false;

        $data = $this->validate(request(), [
            'title' => 'required|between:5,100',
            'body' => 'required',
            'slug' => 'required|alpha_dash|unique:posts,slug',
            'description' => 'required|max:255',
        ]);

        Post::create([
            'title' => $data['title'],
            'body' => $data['body'],
            'slug' => $data['slug'],
            'description' => $data['description'],
            'files' => null,
            'published' => $published,
        ]);

        return redirect('/');
    }

    public function edit(Post $post)
    {
        return view('posts.edit', compact('post'));
    }

    public function update(Post $post)
    {
        $published = request('published') === 'on' ? true : false;

        $data = $this->validate(request(), [
            'title' => 'required|between:5,100',
            'body' => 'required',
            'slug' => 'required|alpha_dash',
            'description' => 'required|max:255',
        ]);

        $post->update([
            'title' => $data['title'],
            'body' => $data['body'],
            'slug' => $data['slug'],
            'description' => $data['description'],
            'files' => null,
            'published' => $published,
        ]);

        return redirect('/posts/' . $post->slug);
    }

    public function destroy(Post $post)
    {
        $post->delete();

        return redirect('/');
    }
}
