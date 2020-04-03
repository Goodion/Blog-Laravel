<?php

namespace App\Http\Controllers;

use App\Comment;
use App\News;
use App\Service\CommentSaver;
use App\Service\TagSaver;
use App\Tag;
use Illuminate\Http\Request;

class NewsController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth')->except('index', 'show');

    }

    public function index()
    {
        $news = News::with('tags')->with('comments')->latest()->get();

        return view('news.news', compact('news'));
    }

    public function store(News $news, TagSaver $tagSaver)
    {
        $this->authorize('update', $news);

        $news = $news->create(\request()->validate([
            'title' => 'required|between:5,100',
            'body' => 'required',
        ]));

        $tags = collect(explode(',', request('tags')))->keyBy(function ($item) { return $item; });
        $tagSaver->store($news, $tags);

        flash('Новость успешно создана');

        return redirect('/news');
    }

    public function storeComment(News $news, Comment $comment, CommentSaver $commentSaver)
    {
        $this->authorize('update', $comment);

        $commentSaver
            ->setComment(request('comment'))
            ->validate()
            ->store($news)
            ? flash('Комментарий успешно добавлен')
            : flash('Произошла ошибка!', 'error')
        ;

        return back();

    }

    public function show(News $news)
    {
        return view('news.show', compact('news'));
    }

    public function edit(News $news)
    {
        $this->authorize('update', $news);

        return view('news.edit', compact('news'));
    }

    public function update(Request $request, News $news, TagSaver $tagSaver)
    {
        $this->authorize('update', $news);

        $news->update($this->validate(request(), [
            'title' => 'required|between:5,100',
            'body' => 'required',
        ]));

        $tags = collect(explode(',', request('tags')))->keyBy(function ($item) { return $item; });
        $tagSaver->store($news, $tags);

        flash('Новость успешно изменена');

        return back();
    }

    public function destroy(News $news)
    {
        $this->authorize('delete', $news);
        $news->delete();

        flash('Новость удалена', 'warning');

        return redirect('/news');
    }
}
