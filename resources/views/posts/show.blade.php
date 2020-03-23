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
                    <p class="blog-post-meta">{{ $post->created_at }}, автор {{ $post->author->name }}</p>
                    <p>{!! $post->body !!}</p>

                    @include('tags.tags', ['tags' => $post->tags])

                </div><!-- /.blog-post -->
                <div class="container">
                    <div class="row">
                        @can('update', $post)
                        <div class="col-auto mr-auto">
                            <form method="post" action="/posts/{{ $post->slug }}">
                                @csrf
                                @method('patch')
                                <a href="/posts/{{ $post->slug }}/edit" class="btn btn-primary">Редактировать</a>
                            </form>
                        </div>
                        <div class="col-auto">
                            <form method="post" action="/posts/{{ $post->slug }}">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="btn btn btn-secondary">Удалить</button>
                            </form>
                        </div>
                        @endcan
                    </div>
                </div>

                @include('comments.comments', ['comments' => $post->comments, 'action' => 'poststorecomment/' . $post->slug])

            </div><!-- /.blog-main -->

            @include('layout.sidebar')

        </div><!-- /.row -->

    </main><!-- /.container -->

@endsection
