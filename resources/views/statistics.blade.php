@extends('layout.additional_page')

@section('title', 'Статистика')

@section('description_content')
    <p class="lead text-muted">Статистические данные блога.</p>
@endsection

@section('page_content')
    <div class="container">
        <table class="table table-bordered">
            <tbody>
                <tr>
                    <th scope="row">Всего постов</th>
                    <td>{{ $statistics['overallPosts'] }}</td>
                    <td></td>
                </tr>
                <tr>
                    <th scope="row">Всего новостей</th>
                    <td>{{ $statistics['overallNews'] }}</td>
                    <td></td>
                </tr>
                <tr>
                    <th scope="row">Пользователь с большим количеством постов</th>
                    <td>{{ $statistics['userWithMaxPosts']->total }}</td>
                    <td>{{ $statistics['userWithMaxPosts']->name }}</td>
                </tr>
                <tr>
                    <th scope="row">Самая длинная статья</th>
                    <td>{{ $statistics['longestPost']->length }}</td>
                    <td><a href="/posts/{{ $statistics['longestPost']->slug }}" class="text-info">{{ $statistics['longestPost']->title }}</a></td>
                </tr>
                <tr>
                    <th scope="row">Самая короткая статья</th>
                    <td>{{ $statistics['shortestPost']->length }}</td>
                    <td><a href="/posts/{{ $statistics['shortestPost']->slug }}" class="text-info">{{ $statistics['shortestPost']->title }}</a></td>
                </tr>
                <tr>
                    <th scope="row">Среднее количество статей у активных пользователей</th>
                    <td>{{ $statistics['averagePosts'] }}</td>
                    <td></td>
                </tr>
                <tr>
                    <th scope="row">Статья, которую меняли больше всего раз</th>
                    <td>{{ $statistics['oftenUpdatedPost']->total }}</td>
                    <td><a href="/posts/{{ $statistics['oftenUpdatedPost']->slug }}" class="text-info">{{ $statistics['oftenUpdatedPost']->title }}</a></td>
                </tr>
                <tr>
                    <th scope="row">Самая обсуждаемая статья</th>
                    <td>{{ $statistics['postWithMostNews']->total }}</td>
                    <td><a href="/posts/{{ $statistics['postWithMostNews']->slug }}" class="text-info">{{ $statistics['postWithMostNews']->title }}</a></td>
                </tr>
            </tbody>
        </table>
    </div>
@endsection
