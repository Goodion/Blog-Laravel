<?php

namespace App\Http\Controllers;

use App\Comment;
use App\News;
use App\Post;
use App\Tag;
use Illuminate\Http\Request;

class CommentsController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function storeComment(Comment $comment)
    {
        $this->authorize('update', $comment);

        $commentText = $this->validate(request(), [
            'comment' => 'required|between:5,100'
        ]);

        $comment = $comment->create(array_merge($commentText, [
            'author_id' => auth()->id(),
        ]));

        $post->comments()->save($comment);

        flash('Комментарий успешно добавлен');

        return back();
    }

    public function destroyComment(Comment $comment)
    {
        $this->authorize('delete', $comment);
        $comment->delete();

        flash('Комментарий удалён', 'warning');

        return back();
    }
}
