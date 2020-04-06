<?php

namespace App\Http\Controllers;

use App\Feedback;

class FeedbacksController extends Controller
{
    public function index()
    {
        $feedbacks = \Cache::tags(['skillbox_laravel_feedbacks'])->remember('feedbacks', 3600*24, function () {
            return Feedback::latest()->get();
        });

        return view('feedbacks.feedbacks', compact('feedbacks'));
    }

    public function store()
    {
        $data = $this->validate(request(), [
            'email' => 'required|email',
            'message' => 'required',
        ]);

        Feedback::create($data);

        return redirect('/feedbacks');
    }
}
