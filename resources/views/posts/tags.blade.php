@php
    $tags = $tags ?? collect();
@endphp

@if($tags->isNotEmpty())
    @yield('caption')
    @foreach($tags as $tag)
        <a href="/posts/tags/{{ $tag->getRouteKey() }}" class="badge badge-info text-light">{{ $tag->name }}</a>
    @endforeach
    @yield('endCaption')
@endif
