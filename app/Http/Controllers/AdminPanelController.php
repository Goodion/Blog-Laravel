<?php

namespace App\Http\Controllers;

use App\Post;
use App\User;
use Illuminate\Http\Request;

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
        $dateFrom = request('dateFrom');
        $dateTo = request('dateTo');

        $emails = (new User)->getAllEmails();

        foreach ($emails as $email) {
            \Mail::to($email)->send(
                new \App\Mail\PostsPublishedInPeriod($dateFrom, $dateTo)
            );
        }

        return redirect('/admin');
    }
}
