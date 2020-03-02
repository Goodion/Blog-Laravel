<?php

use App\Post;
use App\Tag;

Route::get('/posts/tags/{tag}', 'TagsController@index');
Route::get('/', 'PostsController@index');

Route::resource('posts', 'PostsController');

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


Auth::routes();
