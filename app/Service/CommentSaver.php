<?php


namespace App\Service;

use App\Comment;
use Illuminate\Support\Facades\Validator;

class CommentSaver
{
    public function store($instance, Comment $comment)
    {
        $instance->comments()->save($comment);

        flash('Комментарий успешно добавлен');
    }
}
