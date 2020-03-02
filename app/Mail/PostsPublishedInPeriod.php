<?php

namespace App\Mail;

use App\Post;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class PostsPublishedInPeriod extends Mailable
{
    use Queueable, SerializesModels;

    public $posts;
    public $dateFrom;
    public $dateTo;

    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct($dateFrom, $dateTo)
    {
        $this->dateFrom = $dateFrom . ' 00:00:00';
        $this->dateTo = $dateTo . ' 23:59:59';
        $this->posts = Post::whereBetween('updated_at', [$this->dateFrom, $this->dateTo])->get()->allCompleted();

    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        return $this->markdown('mail.posts-published');
    }
}
