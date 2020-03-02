<?php

namespace App\Http\Controllers;

use App\Feedback;

class FeedbacksController extends Controller
{
    public function index()
    {
        $feedbacks = Feedback::latest()->get();
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
