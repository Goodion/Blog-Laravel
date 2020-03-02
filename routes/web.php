<?php

use App\Post;
use App\User;

Route::get('/posts/tags/{tag}', 'TagsController@index');

Route::get('/', 'PostsController@index');
Route::resource('posts', 'PostsController');

Route::get('/contacts', function () {
    return view('contacts');
});

Route::get('/about', function () {
    return view('about');
});

Route::get('/feedbacks', 'FeedbacksController@index');
Route::post('/feedbacks', 'FeedbacksController@store');

Route::get('/admin', function () {
    $posts = Post::with('tags')->latest()->get();

    if (Gate::allows('adminPanel')) {
        return view('admin_panel', compact('posts'));
    } else {
        return back();
    }
});

Route::post('/postsmailing', function () {
    $dateFrom = request('fromDate');
    $dateTo = request('toDate');

    $emails = User::all()->pluck('email');

    foreach ($emails as $email) {
        \Mail::to($email)->send(
            new \App\Mail\PostsPublishedInPeriod($dateFrom, $dateTo)
        );
     }

    return redirect('/admin');
});

Auth::routes();
