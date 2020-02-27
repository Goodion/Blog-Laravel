<?php

use App\Post;
use App\Tag;

Route::get('/posts/tags/{tag}', 'TagsController@index');

Route::get('/', 'PostsController@index');
Route::get('/posts/create', 'PostsController@create');
Route::get('/posts/{post}', 'PostsController@show');
Route::post('/posts', 'PostsController@store');
Route::get('/posts/{post}/edit', 'PostsController@edit');
Route::patch('/posts/{post}', 'PostsController@update');
Route::delete('/posts/{post}', 'PostsController@destroy');

Route::get('/contacts', function () {
    $title = 'Контакты';
    return view('contacts', compact('title'));
});

Route::get('/about', function () {
    $title = 'О нас';
    return view('about', compact('title'));
});

Route::get('/admin', function () {
    $title = 'Панель администратора';
    return view('admin', compact('title'));
});

Route::get('/feedbacks', 'FeedbacksController@index');
Route::post('/feedbacks', 'FeedbacksController@store');

