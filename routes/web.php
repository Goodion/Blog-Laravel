<?php

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

Route::get('/admin', 'AdminPanelController@index');
Route::post('/admin/postsmailing', 'AdminPanelController@postsMailing');

Auth::routes();
