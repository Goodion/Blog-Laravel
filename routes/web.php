<?php

use App\Post;

Route::get('/', 'PostsController@index');
Route::get('/posts/create', 'PostsController@create');
Route::post('/posts', 'PostsController@store');
Route::get('/posts/{post}', 'PostsController@show');

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

