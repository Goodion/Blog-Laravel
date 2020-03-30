<?php

namespace App\Http\Controllers;

use App\Comment;
use App\Jobs\StatisticsReport;
use App\News;
use App\Post;
use App\Tag;
use App\User;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Artisan;

class AdminPanelController extends Controller
{
    public function index()
    {
        $posts = Post::with('tags')->latest()->get();

        if (\Gate::allows('adminPanel')) {
            return view('admin_panel', compact('posts'));
        } else {
            return back();
        }
    }

    public function postsMailing()
    {
        Artisan::call('app:posts_mailing', [
            'dateFrom' => new Carbon(request('dateFrom')),
            'dateTo' => new Carbon(request('dateTo'))
        ]);

        return redirect('/admin');
    }

    public function reportsGeneration()
    {
        $reportsArray = \request('reports');
        $reports = 'Отчёт.' . PHP_EOL;
        if($reportsArray) {
            foreach ($reportsArray as $key => $report) {
                if(method_exists($this, $report)) {
                    $reports .= $this->$report();
                }
            }
        }

        StatisticsReport::dispatch($reports, auth()->user());

        flash('Отчёт запрошен');

        return back();
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
