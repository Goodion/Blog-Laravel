<?php


namespace App\Service;

use App\Comment;
use Illuminate\Support\Facades\Validator;

class CommentSaver
{
    public function store($instance, Comment $comment)
    {
        $validator = Validator::make(
            ['comment' => request('comment')],
            ['comment' => 'required|between:5,100']
        );

        if ($validator->fails()) {
            return back()->withErrors($validator->errors());
        }

        $comment->author_id = auth()->id();
        $comment->comment = request('comment');
        $instance->comments()->save($comment);

        flash('Комментарий успешно добавлен');
    }
}
