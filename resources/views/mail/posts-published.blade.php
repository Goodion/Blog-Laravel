@component('mail::message')
# С {{ $fromDate }} по {{ $toDate }} опубликованы:

@foreach($posts as $post)
        Заголовок - {{ $post->title }}
        Создана {{ $post->created_at->toFormattedDateString() }}, автор {{ $post->author->name }}.
        Описание - {{ $post->description }}
@endforeach

Thanks,<br>
{{ config('app.name') }}
@endcomponent
