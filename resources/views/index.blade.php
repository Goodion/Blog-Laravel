@extends('layout.master')

@section('title', 'Главная')

@section('content')

<main role="main" class="container">
    <div class="row">
        <div class="col-md-8 blog-main">
            <h3 class="pb-4 mb-4 font-italic border-bottom">
                @yield('title')
            </h3>

            @foreach ($posts as $post)
            <div class="blog-post">
                <h2 class="blog-post-title"><a href="/posts/{{ $post->slug }}" class="text-dark text-decoration-none">{{ $post->title }}</a></h2>
                <p class="blog-post-meta">{{ $post->created_at->toFormattedDateString() }}, автор {{ $post->user->name }}</p>
                <p>{{ $post->description }}</p>

                @include('posts.tags', ['tags' => $post->tags])

            </div><!-- /.blog-post -->
            @endforeach

            <nav class="blog-pagination">
                <a class="btn btn-outline-primary" href="#">Older</a>
                <a class="btn btn-outline-secondary disabled" href="#" tabindex="-1" aria-disabled="true">Newer</a>
            </nav>

        </div><!-- /.blog-main -->

        @include('layout.sidebar')

    </div><!-- /.row -->

</main><!-- /.container -->

@endsection
