@component('mail::message')
# Добавлена статья: {{ $post->title }}
Автор - {{ $post->author->name }}

{{ $post->description }}

@component('mail::button', ['url' => 'http://blog.goodion.ru/posts/'. $post->slug])
Перейти к статье
@endcomponent

Спасибо,<br>
{{ config('app.name') }}
@endcomponent
