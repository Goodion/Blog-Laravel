<div class="container">
    <div class="row">
        @include('layout.errors')

        <div class="container">
            <form method="POST" action="{{ $action }}">
                @csrf
                <div class="form-group">
                    <label for="comment">Комментарий</label>
                    <input class="form-control" id="comment" name="comment" value="{{ old('comment') }}">
                    <small id="commentHelp" class="form-text text-muted">
                        Не менее 5 и не более 100 символов.
                    </small>
                </div>
                <hr>
                <button type="submit" class="btn btn-primary">Сохранить</button>
            </form>
        </div>
    </div>
</div>
