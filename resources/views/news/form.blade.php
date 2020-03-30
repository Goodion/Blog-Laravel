@include('layout.errors')

<div class="form-group">
    <label for="title">Заголовок новости</label>
    <input class="form-control" id="title" name="title" value="{{ old('title', $news->title ?? '') }}">
    <small id="titleHelp" class="form-text text-muted">
        Не менее 5 и не более 100 символов.
    </small>
</div>
<div class="form-group">
    <label for="news_body">Текст</label>
    <textarea class="form-control" id="news_body" name="body">{{ old('body', $news->body ?? '') }}</textarea>
</div>
<div class="form-group">
    <label for="inputTags">Теги</label>
    <input class="form-control" id="inputTags" name="tags" value="{{ old('tags', isset($news) ? $news->tags->pluck('name')->implode(',') : '') }}">
    <small id="inputTagsHelp" class="form-text text-muted">
        Введите теги через запятую, без пробелов.
    </small>
</div>
<hr>
<button type="submit" class="btn btn-primary">Сохранить</button>
