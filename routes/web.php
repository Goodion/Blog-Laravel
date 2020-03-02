<?php

use App\Post;
use App\Tag;

Route::get('/posts/tags/{tag}', 'TagsController@index');

Route::get('/', 'PostsController@index');
Route::resource('posts', 'PostsController');

Route::get('/contacts', function () {
    return view('contacts');
});

Route::get('/about', function () {
    return view('about');
});

Route::get('/admin', function () {
    $posts = Post::with('tags')->latest()->get();

    if (Gate::allows('adminPanel')) {
        return view('admin_panel', compact('posts'));
    } else {
        return back();
    }
});

Route::get('/feedbacks', 'FeedbacksController@index');
Route::post('/feedbacks', 'FeedbacksController@store');


Auth::routes();
