<div class="container">
    <div class="row">
        <blockquote class="blockquote text-right">
            <h4>Комментарии</h4>
            @foreach($comments as $comment)
            <p class="mb-0">{{ $comment->comment }}</p>
            <footer class="blockquote-footer">
                <cite title="Автор">
                    {{ $comment->author->name }}
                </cite>
                <span class="small">
                    {{ $comment->created_at }}
                </span>
            </footer>
            @endforeach
        </blockquote>
    </div>
    <div class="row">
        @include('comments.form')
    </div>
</div>
