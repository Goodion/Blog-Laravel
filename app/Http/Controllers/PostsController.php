<?php

namespace App\Http\Controllers;

use App\Post,
    App\Tag;

class PostsController extends Controller
{
    public function index()
    {
        $posts = Post::with('tags')->latest()->get();
        $tagsCloud = collect(Tag::all());
        return view('index', compact('posts', 'tagsCloud'));
    }

    public function show(Post $post)
    {
        $tagsCloud = collect(Tag::all());
        return view('posts.show', compact('post', 'tagsCloud'));
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

        $post = Post::create([
            'title' => $data['title'],
            'body' => $data['body'],
            'slug' => $data['slug'],
            'description' => $data['description'],
            'files' => null,
            'published' => $published,
        ]);

        $tags = collect(explode(',', request('tags')))->keyBy(function ($item) { return $item; });
        foreach ($tags as $tag) {
            $tag = Tag::firstOrCreate(['name' => $tag]);
            $post->tags()->attach($tag);
        }

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

        $postTags = $post->tags->keyBy('name');
        $tags = collect(explode(',', request('tags')))->keyBy(function ($item) { return $item; });

        $tagsToAttach = $tags->diffKeys($postTags);
        $tagsToDetach = $postTags->diffKeys($tags);

        foreach ($tagsToAttach as $tag) {
            $tag = Tag::firstOrCreate(['name' => $tag]);
            $post->tags()->attach($tag);
        }

        foreach ($tagsToDetach as $tag) {
            $post->tags()->detach($tag);
            $tag->deleteIfNotUsed();
        }

        return redirect('/posts/' . $post->slug);
    }

    public function destroy(Post $post)
    {
        $tagsToDetach = $post->tags->keyBy('name');

        $post->delete();

        foreach ($tagsToDetach as $tag) {
            $post->tags()->detach($tag);
            $tag->deleteIfNotUsed();
        }


        return redirect('/');
    }
}
