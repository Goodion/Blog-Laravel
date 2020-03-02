@component('mail::message')
# Удалена статья: {{ $post->title }}
пользователем - {{ auth()->user()->name }}

Спасибо,<br>
{{ config('app.name') }}
@endcomponent
