@extends('layout.master')

@section('content')
    <div class="container">
        <form method="POST" action="/posts">

            @csrf

            @include('layout.errors')

            <div class="form-group">
                <label for="slug">Символьный код</label>
                <input class="form-control" id="slug" name="slug">
                <small id="slugHelp" class="form-text text-muted">
                    Обязательное текстовое поле. Должно состоять только из латинских символов,
                    цифр, символов тире и подчеркивания. Поле должно быть уникальным на все статьи.
                </small>
            </div>
            <div class="form-group">
                <label for="title">Заголовок статьи</label>
                <input class="form-control" id="title" name="title">
                <small id="titleHelp" class="form-text text-muted">
                    Не менее 5 и не более 100 символов.
                </small>
            </div>
            <div class="form-group">
                <label for="description">Краткое описание статьи</label>
                <input class="form-control" id="description" name="description">
                <small id="descriptionHelp" class="form-text text-muted">
                    Не более 255 символов.
                </small>
            </div>
            <div class="form-group">
                <label for="post_body">Текст</label>
                <textarea class="form-control" id="post_body" name="body"></textarea>
            </div>
            <div class="form-group form-check">
                <input type="checkbox" class="form-check-input" id="published" name="published">
                <label class="form-check-label" for="published">Опубликовать</label>
            </div>
            <button type="submit" class="btn btn-primary">Сохранить</button>
        </form>
    </div>
@endsection
