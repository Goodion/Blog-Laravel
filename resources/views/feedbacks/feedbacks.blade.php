@extends('layout.master')

@section('content')

    <section class="jumbotron text-center">
        <div class="container">
            <h1 class="jumbotron-heading">{{ $title }}</h1>
        </div>
    </section>

    <div class="container">
        @foreach($feedbacks as $feedback)
        <div class="row">
            <div class="col">
                {{ $feedback->email }}
            </div>
            <div class="col-6">
                {{ $feedback->message }}
            </div>
            <div class="col">
                {{ $feedback->created_at }}
            </div>
        </div>
            @endforeach
    </div>

@endsection
