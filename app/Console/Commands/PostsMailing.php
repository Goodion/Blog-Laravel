<?php

namespace App\Console\Commands;

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

        foreach ($emails as $email) {
            \Mail::to($email)->send(
                new \App\Mail\PostsPublishedInPeriod($this->argument('dateFrom'), $this->argument('dateTo'))
            );
        }
    }
}
