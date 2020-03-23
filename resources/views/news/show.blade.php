@extends('layout.master')

@section('title', 'Новость № ' . $news->id)

@section('content')

    <main role="main" class="container">
        <div class="row">
            <div class="col-md-8 blog-main">
                <h3 class="pb-4 mb-4 font-italic border-bottom">
                    @yield('title')
                </h3>
                <div class="blog-post">
                    <h2 class="blog-post-title">{{ $news->title }}</h2>
                    <p class="blog-post-meta">{{ $news->created_at }}</p>
                    <p>{{ $news->body }}</p>

                    @include('tags.tags', ['tags' => $news->tags])

                </div><!-- /.blog-post -->
                <div class="container">
                    <div class="row">
                        @can('update', $news)
                            <div class="col-auto mr-auto">
                                <form method="post" action="/news/{{ $news->id }}">
                                    @csrf
                                    @method('patch')
                                    <a href="/news/{{ $news->id }}/edit" class="btn btn-primary">Редактировать</a>
                                </form>
                            </div>
                            <div class="col-auto">
                                <form method="post" action="/news/{{ $news->id }}">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="btn btn btn-secondary">Удалить</button>
                                </form>
                            </div>
                        @endcan
                    </div>
                </div>
            </div><!-- /.blog-main -->

            @include('layout.sidebar')

        </div><!-- /.row -->

    </main><!-- /.container -->

@endsection
