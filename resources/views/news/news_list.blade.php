@foreach ($news as $singleNews)
    <div class="blog-post">
        <h3><a href="/news/{{ $singleNews->id }}" class="text-dark text-decoration-none">{{ $singleNews->title }}</a></h3>
        <p class="blog-post-meta">{{ $singleNews->created_at->toFormattedDateString() }}</p>

        @include('tags.tags', ['tags' => $singleNews->tags])

    </div><!-- /.blog-post -->
@endforeach
