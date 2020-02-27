@extends('layout.master')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">{{ __('Подтвердите Ваш E-mail адрес') }}</div>

                <div class="card-body">
                    @if (session('resent'))
                        <div class="alert alert-success" role="alert">
                            {{ __('Ссылка для подтверждения E-mail адреса отправлена повторно.') }}
                        </div>
                    @endif

                    {{ __('Перед продолжением, проверьте Ваш почтовый ящик') }}
                    {{ __('Если Вы не получили письмо') }},
                    <form class="d-inline" method="POST" action="{{ route('verification.resend') }}">
                        @csrf
                        <button type="submit" class="btn btn-link p-0 m-0 align-baseline">{{ __('нажмите сюда, чтобы отправить ещё одно') }}</button>.
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
