@extends('layout.master')

@section('title', 'Редактирование статьи')

@section('content')
    <section class="jumbotron text-center">
        <div class="container">
            <h1 class="jumbotron-heading">@yield('title')</h1>
        </div>
    </section>
    <div class="container">
        <form method="POST" action="/posts/{{ $post->slug }}">

            @csrf
            @method('PATCH')

            @include('posts.form')

        </form>
        <form method="post" action="/posts/{{ $post->slug }}">
            @csrf
            @method('DELETE')
            <button type="submit" class="btn btn btn-secondary">Удалить</button>
        </form>
    </div>
@endsection
