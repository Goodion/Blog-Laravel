@extends('layout.additional_page')

@section('title', 'Панель администратора')

@section('description_content')
    <p class="lead text-muted">Something short and leading about the collection below—its contents, the creator,
        etc. Make it short and sweet, but not too short so folks don’t simply skip over it entirely.
        Something short and leading about the collection below—its contents, the creator, etc.
        Make it short and sweet, but not too short so folks don’t simply skip over it entirely.
    </p>
@endsection

@section('page_content')
    <div class="container">
        <div class="row my-3">
            <div class="col-12 border">
                <h5 class="text-center pt-3">Добавление новости</h5>
                <form method="POST" action="/news">

                    @csrf

                    @include('news.form')

                </form>
            </div>
            <div class="col-8 border">
                <h5 class="text-center pt-3">Отбор статистики</h5>
                <form method="POST" action="{{ action('AdminPanelController@reportsGeneration') }}">

                    @csrf

                    <div class="container">
                        <div class="row py-3">
                            <div class="col-12">
                                <div class="form-check">
                                    <input class="form-check-input" type="checkbox" name="reports[]" value="newsReport" @if(is_array(request()->reports) && in_array('newsReport', request()->reports)) checked @endif>
                                    <label class="form-check-label" for="newsReport">
                                        Новости
                                    </label>
                                </div>
                                <div class="form-check">
                                    <input class="form-check-input" type="checkbox" name="reports[]" value="postsReport" @if(is_array(request()->reports) && in_array('postsReport', request()->reports)) checked @endif>
                                    <label class="form-check-label" for="postsReport">
                                        Статьи
                                    </label>
                                </div>
                                <div class="form-check">
                                    <input class="form-check-input" type="checkbox" name="reports[]" value="commentsReport" @if(is_array(request()->reports) && in_array('commentsReport', request()->reports)) checked @endif>
                                    <label class="form-check-label" for="commentsReport">
                                        Комментарии
                                    </label>
                                </div>
                                <div class="form-check">
                                    <input class="form-check-input" type="checkbox" name="reports[]" value="tagsReport" @if(is_array(request()->reports) && in_array('tagsReport', request()->reports)) checked @endif>
                                    <label class="form-check-label" for="tagsReport">
                                        Теги
                                    </label>
                                </div>
                                <div class="form-check">
                                    <input class="form-check-input" type="checkbox" name="reports[]" value="usersReport" @if(is_array(request()->reports) && in_array('usersReport', request()->reports)) checked @endif>
                                    <label class="form-check-label" for="usersReport">
                                        Пользователи
                                    </label>
                                </div>
                            </div>
                        </div>
                        <button class="btn btn-primary" type="submit">Сгенерировать</button>
                    </div>
                </form>
            </div>
            <div class="col-4 border">
                <h5 class="text-center pt-3">Рассылка опубликованных статей за выбранные даты</h5>
                <form method="post" action="{{ action('AdminPanelController@postsMailing') }}">

                    @csrf
                    @method('POST')

                    <div class="form-group">
                        <label for="fromDate">С даты:</label>
                        <input type="date" class="form-control" id="fromDate" name="dateFrom">
                    </div>
                    <div class="form-group">
                        <label for="toDate">По дату:</label>
                        <input type="date" class="form-control" id="toDate" name="dateTo">
                    </div>
                    <button type="submit" class="btn btn-primary">Разослать</button>
                </form>
            </div>
            <div class="col-4"></div>
        </div>

         <table class="table table-bordered">
            <thead>
            <tr>
                <th scope="col">Заголовок</th>
                <th scope="col">Описание</th>
                <th scope="col">Автор</th>
                <th scope="col">Дата создания</th>
                <th scope="col">Опубл.</th>
                <th scope="col"></th>
            </tr>
            </thead>
             @foreach ($posts as $post)
                 <tbody>
                    <tr>
                        <th scope="row"><a href="/posts/{{ $post->slug }}" class="text-info">{{ $post->title }}</a></th>
                        <td>{{ $post->description }}</td>
                        <td>{{ $post->author->name }}</td>
                        <td>{{ $post->created_at->toFormattedDateString() }}</td>
                        <td>
                            <form method="POST" action="/posts/{{ $post->slug }}">
                                @csrf
                                @method('PATCH')
                                <input hidden name="title" value="{{ $post->title }}">
                                <input hidden name="body" value="{{ $post->body }}">
                                <input hidden name="slug" value="{{ $post->slug }}">
                                <input hidden name="description" value="{{ $post->description }}">
                                <input type="checkbox" id="published" name="published" {{ $post->published ? 'checked' : '' }} onclick="this.form.submit()">
                            </form>
                        </td>
                        <td>
                            <form method="post" action="/posts/{{ $post->slug }}">
                                @csrf
                                @method('DELETE')
                                <input hidden name="redirect" value="back">
                                <button type="submit" class="badge badge-danger">Del</button>
                            </form>
                        </td>
                    </tr>
                 </tbody>
             @endforeach
         </table>
    </div>
@endsection
