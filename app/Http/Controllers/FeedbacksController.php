<?php

namespace App\Http\Controllers;

use App\Feedback;

class FeedbacksController extends Controller
{
    public function index()
    {
        $feedbacks = Feedback::latest()->get();
        $title = 'Обращения';
        return view('feedbacks.feedbacks', compact('feedbacks', 'title'));
    }

    public function store()
    {
        $this->validate(request(), [
            'email' => 'required|email',
            'message' => 'required',
        ]);

        Feedback::create(request()->all());

        return redirect('/feedbacks');
    }
}
