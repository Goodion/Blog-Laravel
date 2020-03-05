<?php

namespace App\Mail;

use App\Post;
use Carbon\Carbon;
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
        $this->dateFrom = (new Carbon($dateFrom))->toDateString();
        $this->dateTo = (new Carbon($dateTo))->addDay()->toDateString();
        $this->posts = (new Post)->publishedInPeriod($this->dateFrom, $this->dateTo);
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
