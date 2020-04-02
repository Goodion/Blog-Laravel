<?php

namespace App\Jobs;

use App\Comment;
use App\Events\ReportFormed;
use App\News;
use App\Notifications\StatisticsReportNotification;
use App\Post;
use App\Tag;
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
        $reports = 'Отчёт.' . PHP_EOL;
        if($this->reports) {
            foreach ($this->reports as $key => $report) {
                if(method_exists($this, $report)) {
                    $reports .= $this->$report();
                }
            }
        }

        $this->admin->notify(new StatisticsReportNotification($reports));

        event(new ReportFormed($reports, $this->admin));
    }

    protected function newsReport()
    {
        return 'Новостей: ' . News::count() . PHP_EOL;
    }

    protected function postsReport()
    {
        return 'Статей: ' . Post::count() . PHP_EOL;
    }

    protected function commentsReport()
    {
        return 'Комментариев: ' . Comment::count() . PHP_EOL;
    }

    protected function tagsReport()
    {
        return 'Тэгов: ' . Tag::count() . PHP_EOL;
    }

    protected function usersReport()
    {
        return 'Пользователей: ' . User::count() . PHP_EOL;
    }
}
