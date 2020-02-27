@php
    $tags = $tags ?? collect();
@endphp

@if($tags->isNotEmpty())
    <div class="p-4 mb-3 bg-light rounded">
        <h4 class="font-italic">Теги</h4>
    @foreach($tags as $tag)
        <a href="/posts/tags/{{ $tag->getRouteKey() }}" class="badge badge-info text-light">{{ $tag->name }}</a>
    @endforeach
    </div>
@endif
