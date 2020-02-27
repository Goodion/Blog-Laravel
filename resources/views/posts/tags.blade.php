@php
    $tags = $tags ?? collect();
@endphp

@if($tags->isNotEmpty())
    @foreach($tags as $tag)
        <a href="/posts/tags/{{ $tag->getRouteKey() }}" class="badge badge-info text-light">{{ $tag->name }}</a>
    @endforeach
@endif
