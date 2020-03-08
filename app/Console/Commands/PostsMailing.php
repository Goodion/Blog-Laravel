<?php

namespace App\Console\Commands;

use App\Post;
use App\User;
use Carbon\Carbon;
use Illuminate\Console\Command;

class PostsMailing extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'app:posts_mailing {dateFrom} {dateTo}';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Sends emails to all users with posts published in the specified period';

    /**
     * Create a new command instance.
     *
     * @return void
     */
    public function __construct()
    {
        parent::__construct();
    }

    /**
     * Execute the console command.
     *
     * @return mixed
     */
    public function handle()
    {
        $emails = (new User)->getAllEmails();
        $dateFrom = new Carbon($this->argument('dateFrom'));
        $dateTo = new Carbon($this->argument('dateTo'));
        $posts = (new Post)->publishedInPeriod($dateFrom, $dateTo);

        foreach ($emails as $email) {
            \Mail::to($email)->send(
                new \App\Mail\PostsPublishedInPeriod($dateFrom, $dateTo, $posts)
            );
        }
    }
}
