<?php

namespace App\Http\Controllers;

use App\Jobs\StatisticsReport;
use App\Post;
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
        StatisticsReport::dispatch(\request('reports'), auth()->user())->onQueue('reports');

        flash('Отчёт запрошен');

        return back();
    }

}
