@component('mail::message')
# Изменена статья: {{ $post->title }}
пользователем - {{ auth()->user()->name }}

{{ $post->description }}

@component('mail::button', ['url' => 'http://blog.goodion.ru/posts/'. $post->slug])
    Перейти к статье
@endcomponent

Спасибо,<br>
{{ config('app.name') }}
@endcomponent
