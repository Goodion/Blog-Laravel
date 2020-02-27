@extends('layout.master')

@section('title', 'Создание статьи')

@section('content')
    <section class="jumbotron text-center">
        <div class="container">
            <h1 class="jumbotron-heading">@yield('title')</h1>
        </div>
    </section>
    <div class="container">
        <form method="POST" action="/posts">

            @csrf

            @include('layout.errors')

            <div class="form-group">
                <label for="slug">Символьный код</label>
                <input class="form-control" id="slug" name="slug" value="{{ old('slug') }}">
                <small id="slugHelp" class="form-text text-muted">
                    Обязательное текстовое поле. Должно состоять только из латинских символов,
                    цифр, символов тире и подчеркивания. Поле должно быть уникальным на все статьи.
                </small>
            </div>
            <div class="form-group">
                <label for="title">Заголовок статьи</label>
                <input class="form-control" id="title" name="title" value="{{ old('title') }}">
                <small id="titleHelp" class="form-text text-muted">
                    Не менее 5 и не более 100 символов.
                </small>
            </div>
            <div class="form-group">
                <label for="description">Краткое описание статьи</label>
                <input class="form-control" id="description" name="description" value="{{ old('description') }}">
                <small id="descriptionHelp" class="form-text text-muted">
                    Не более 255 символов.
                </small>
            </div>
            <div class="form-group">
                <label for="post_body">Текст</label>
                <textarea class="form-control" id="post_body" name="body">{{ old('body') }}</textarea>
            </div>
            <div class="form-group">
                <label for="inputTags">Теги</label>
                <input class="form-control" id="inputTags" name="tags" value="{{ old('tags') }}">
                <small id="inputTagsHelp" class="form-text text-muted">
                    Введите теги через запятую, без пробелов.
                </small>
            </div>
            <div class="form-group form-check">
                <input type="checkbox" class="form-check-input" id="published" name="published">
                <label class="form-check-label" for="published">Опубликовать</label>
            </div>
            <button type="submit" class="btn btn-primary">Сохранить</button>
        </form>
    </div>
@endsection
