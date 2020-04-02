<?php

namespace App\Http\Controllers;

use App\Comment;
use App\Notifications\PostCreated;
use App\Notifications\PostDeleted;
use App\Notifications\PostUpdated;
use App\Post,
    App\Tag;
use App\Providers\TelegramMessageServiceProvider;
use App\Service\CommentSaver;
use App\Service\TagSaver;


class PostsController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth')->except('index', 'show');
    }

    public function index()
    {
        $posts = Post::with(['comments', 'tags'])->currentAuthor()->orWhere('published', true)->latest()->get();

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

    public function store(TagSaver $tagSaver)
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
        $tagSaver->store($post, $tags);

        $admin = \App\User::where('email', config('config.admin_email'))->first();
        $admin->notify(new PostCreated($post));

        flash('Статья успешно создана');

        return redirect('/');
    }

    public function storeComment(Post $post, Comment $comment, CommentSaver $commentSaver)
    {
        if ($commentSaver
            ->setComment(request('comment'))
            ->validate()
            ->store($post)) {
            flash('Комментарий успешно добавлен');
        }

        return back();

    }

    public function edit(Post $post)
    {
        $this->authorize('update', $post);

        return view('posts.edit', compact('post'));
    }

    public function update(Post $post, TagSaver $tagSaver)
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

        $tags = collect(explode(',', request('tags')))->keyBy(function ($item) { return $item; });
        $tagSaver->store($post, $tags);

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
