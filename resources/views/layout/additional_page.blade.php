@extends('layout.master')

@section('content')
    <main role="main">
        <section class="jumbotron text-center">
            <div class="container">
                <h1 class="jumbotron-heading">@yield('title')</h1>

                @yield('description_content')

            </div>
        </section>

        @yield('page_content')

    </main>

@endsection
