<?php

namespace App\Http\Controllers;

use App\Notifications\PostCreated;
use App\Notifications\PostDeleted;
use App\Notifications\PostUpdated;
use App\Post,
    App\Tag;
use App\Providers\TelegramMessageServiceProvider;

class PostsController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth')->except('index', 'show');
    }

    public function index()
    {
        $posts = Post::with('tags')->currentAuthor()->orWhere('published', true)->latest()->get();

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

        $post = Post::create(array_merge($data, [
            'files' => null,
            'published' => $published,
            'author_id' => auth()->id(),
        ]));

        $tags = collect(explode(',', request('tags')))->keyBy(function ($item) { return $item; });
        foreach ($tags as $tag) {
            $tag = Tag::firstOrCreate(['name' => $tag]);
            $post->tags()->attach($tag);
        }

        $admin = \App\User::where('email', config('config.admin_email'))->first();
        $admin->notify(new PostCreated($post));

        flash('Статья успешно создана');

        return redirect('/');
    }

    public function edit(Post $post)
    {
        $this->authorize('update', $post);

        return view('posts.edit', compact('post'));
    }

    public function update(Post $post)
    {
        $this->authorize('update', $post);

        $published = request('published') === 'on' ? true : false;

        $data = $this->validate(request(), [
            'title' => 'required|between:5,100',
            'body' => 'required',
            'slug' => 'required|alpha_dash',
            'description' => 'required|max:255',
        ]);

        $post->update(array_merge($data, [
            'files' => null,
            'published' => $published,
        ]));

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
        }

        $admin = \App\User::where('email', config('config.admin_email'))->first();
        $admin->notify(new PostUpdated($post));

        flash('Статья успешно изменена');

        return back();
    }

    public function destroy(Post $post)
    {
        $this->authorize('delete', $post);
        $admin = \App\User::where('email', config('config.admin_email'))->first();
        $admin->notify(new PostDeleted($post));

        $post->delete();

        flash('Статья удалена', 'warning');



        return request('redirect') === 'back' ? back() : redirect('/');
    }
}
