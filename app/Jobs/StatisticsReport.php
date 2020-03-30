<?php

namespace App\Jobs;

use App\Notifications\StatisticsReportNotification;
use App\User;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;

class StatisticsReport implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    protected $reports;
    protected $admin;
    /**
     * Create a new job instance.
     *
     * @return void
     */
    public function __construct($reports, User $user)
    {
        $this->admin = $user;
        $this->reports = $reports;
    }

    /**
     * Execute the job.
     *
     * @return void
     */
    public function handle()
    {
        $this->admin->notify(new StatisticsReportNotification($this->reports));
    }
}
