<?php


namespace App\Service;

use App\Comment;
use Illuminate\Support\Facades\Validator;

class CommentSaver
{
    protected $comment;
    protected $validator;

    public function setComment($comment)
    {
        $this->comment = $comment;
        return $this;
    }

    public function validate()
    {
        $this->validator = Validator::make(
            ['comment' => $this->comment],
            ['comment' => 'required|between:5,100']
        );

        return $this;
    }

    public function store($instance)
    {
        if ($this->validator->fails()) {
            return back()->withErrors($this->validator->errors())->withInput();;
        }

        $comment = Comment::make();
        $comment->author_id = auth()->id();
        $comment->comment = $this->comment;
        $instance->comments()->save($comment);

        return back()->with('message', 'Комментарий успешно добавлен');
    }
}
