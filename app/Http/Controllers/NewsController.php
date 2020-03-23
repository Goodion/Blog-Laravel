<?php

namespace App\Http\Controllers;

use App\News;
use App\Tag;
use Illuminate\Http\Request;

class NewsController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth')->except('index', 'show');
    }

        /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $news = News::with('tags')->latest()->get();

        return view('news.news', compact('news'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(News $news)
    {
        $this->authorize('update', $news);

        $news = $news->create(\request()->validate([
            'title' => 'required|between:5,100',
            'body' => 'required',
        ]));

        $tags = collect(explode(',', request('tags')))->keyBy(function ($item) { return $item; });
        $syncIds = [];
        foreach ($tags as $tag) {
            $tag = Tag::firstOrCreate(['name' => $tag]);

            $syncIds[] = $tag->id;
        }

        $news->tags()->sync($syncIds);

        flash('Новость успешно создана');

        return redirect('/news');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\News  $news
     * @return \Illuminate\Http\Response
     */
    public function show(News $news)
    {
        return view('news.show', compact('news'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\News  $news
     * @return \Illuminate\Http\Response
     */
    public function edit(News $news)
    {
        $this->authorize('update', $news);

        return view('news.edit', compact('news'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\News  $news
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, News $news)
    {
        $this->authorize('update', $news);

        $news->update($this->validate(request(), [
            'title' => 'required|between:5,100',
            'body' => 'required',
        ]));

        $newsTags = $news->tags->keyBy('name');
        $tags = collect(explode(',', request('tags')))->keyBy(function ($item) { return $item; });

        $tagsToAttach = $tags->diffKeys($newsTags);
        $tagsToDetach = $newsTags->diffKeys($tags);

        foreach ($tagsToAttach as $tag) {
            $tag = Tag::firstOrCreate(['name' => $tag]);
            $news->tags()->attach($tag);
        }

        foreach ($tagsToDetach as $tag) {
            $news->tags()->detach($tag);
        }

        flash('Новость успешно изменена');

        return back();
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\News  $news
     * @return \Illuminate\Http\Response
     */
    public function destroy(News $news)
    {
        $this->authorize('delete', $news);
        $news->delete();

        flash('Новость удалена', 'warning');

        return redirect('/news');
    }
}
