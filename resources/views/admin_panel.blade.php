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
            <div class="col-4"></div>
            <div class="col-4 border">
                <h5 class="text-center">Рассылка опубликованных статей за выбранные даты</h5>
                <form method="post" action="/postsmailing">

                    @csrf
                    @method('POST')

                    <div class="form-group">
                        <label for="fromDate">С даты:</label>
                        <input type="date" class="form-control" id="fromDate" name="fromDate">
                    </div>
                    <div class="form-group">
                        <label for="toDate">По дату:</label>
                        <input type="date" class="form-control" id="toDate" name="toDate">
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
