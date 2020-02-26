@extends('layout.master')

@section('title', 'Контакты')

@section('content')

<main role="main">

    <section class="jumbotron text-center">
        <div class="container">
            <h1 class="jumbotron-heading">@yield('title')</h1>
            <p class="lead text-muted">Something short and leading about the collection below—its contents, the creator,
                etc. Make it short and sweet, but not too short so folks don’t simply skip over it entirely.
                Something short and leading about the collection below—its contents, the creator, etc.
                Make it short and sweet, but not too short so folks don’t simply skip over it entirely.
            </p>

        </div>
    </section>
    <div class="container">
        <form method="post" action="/feedbacks">

            @csrf

            @include('layout.errors')

            <div class="form-group">
                <label for="email">Электронная почта</label>
                <input type="email" class="form-control" id="email" aria-describedby="emailHelp" name="email">
            </div>
            <div class="form-group">
                <label for="message">Сообщение</label>
                <input class="form-control" id="message" name="message">
            </div>
            <button type="submit" class="btn btn-primary">Отправить</button>
        </form>
    </div>

</main>

@endsection
