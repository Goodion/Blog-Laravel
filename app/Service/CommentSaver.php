<?php


namespace App\Service;

use App\Comment;
use Doctrine\DBAL\Exception\DatabaseObjectExistsException;
use Exception;
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
        )->validate();

        return $this;
    }

    public function store($instance)
    {
        $comment = Comment::make();
        $comment->author_id = auth()->id();
        $comment->comment = $this->comment;
        $instance->comments()->save($comment);

        return $this;
    }
}
