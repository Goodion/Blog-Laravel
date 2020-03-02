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
    public $fromDate;
    public $toDate;

    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct($fromDate, $toDate)
    {
        $this->fromDate = $fromDate . ' 00:00:00';
        $this->toDate = $toDate . ' 23:59:59';
        $this->posts = Post::whereBetween('updated_at', [$this->fromDate, $this->toDate])->get()->allCompleted();
        
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
