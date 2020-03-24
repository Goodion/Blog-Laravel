<?php

use App\User;

Route::get('/tags/{tag}', 'TagsController@index');

Route::post('/poststorecomment/{post}', 'PostsController@storeComment');
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

Route::post('/newsstorecomment/{news}', 'NewsController@storeComment');
Route::resource('news', 'NewsController');

Route::resource('comments', 'CommentsController');

Route::get('/statistics', 'StatisticsController@index');

Auth::routes();
