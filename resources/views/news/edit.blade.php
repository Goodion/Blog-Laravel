@extends('layout.master')

@section('title', 'Редактирование новости')

@section('content')
    <section class="jumbotron text-center">
        <div class="container">
            <h1 class="jumbotron-heading">@yield('title')</h1>
        </div>
    </section>
    <div class="container">
        <form method="POST" action="/news/{{ $news->id }}">

            @csrf
            @method('PATCH')
            @include('news.form')

        </form>
        <form method="post" action="/news/{{ $news->id }}">
            @csrf
            @method('DELETE')
            <button type="submit" class="btn btn-secondary">Удалить</button>
        </form>
    </div>
@endsection
