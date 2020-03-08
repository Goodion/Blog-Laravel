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
    public function __construct(Carbon $dateFrom, Carbon $dateTo, $posts)
    {
        $this->dateFrom = $dateFrom->toDateString();
        $this->dateTo = $dateTo->addDay()->toDateString();
        $this->posts = $posts;
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
