@extends('layout.master')

@section('title', 'Создание статьи')

@section('content')
    <section class="jumbotron text-center">
        <div class="container">
            <h1 class="jumbotron-heading">@yield('title')</h1>
        </div>
    </section>
    <div class="container">
        <form method="POST" action="/posts">

            @csrf

            @include('posts.form')

        </form>
    </div>
@endsection
