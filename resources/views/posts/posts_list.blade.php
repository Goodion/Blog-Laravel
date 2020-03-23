@foreach ($posts as $post)
    <div class="blog-post">
        <h2 class="blog-post-title"><a href="/posts/{{ $post->slug }}" class="text-dark text-decoration-none">{{ $post->title }}</a></h2>
        <p class="blog-post-meta">{{ $post->created_at->toFormattedDateString() }}, автор {{ $post->author->name }}</p>
        <p>{{ $post->description }}</p>

        @include('tags.tags', ['tags' => $post->tags])

    </div><!-- /.blog-post -->
@endforeach
