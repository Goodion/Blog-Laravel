@extends('layout.master')

@section('title', $post->slug)

@section('content')

    <main role="main" class="container">
        <div class="row">
            <div class="col-md-8 blog-main">
                <h3 class="pb-4 mb-4 font-italic border-bottom">
                    @yield('title')
                </h3>

                    <div class="blog-post">
                        <h2 class="blog-post-title">{{ $post->title }}</h2>
                        <p class="blog-post-meta">{{ $post->created_at }}</p>
                        <p>{{ $post->body }}</p>
                    </div><!-- /.blog-post -->
            <a href="/">На главную</a>
            </div><!-- /.blog-main -->

            @include('layout.sidebar')

        </div><!-- /.row -->

    </main><!-- /.container -->

@endsection
