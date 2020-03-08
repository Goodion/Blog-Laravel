<div class="container">
    <div class="nav-scroller py-1 mb-2">
        <nav class="nav d-flex justify-content-between">
            <a class="p-2 text-muted" href="/">Главная</a>
            <a class="p-2 text-muted" href="/posts/create">Создать статью</a>
            <a class="p-2 text-muted" href="/contacts">Контакты</a>
            <a class="p-2 text-muted" href="/feedbacks">Список обращений</a>
            <a class="p-2 text-muted" href="/about">О нас</a>
            @if(Gate::allows('adminPanel'))
                <a class="p-2 text-muted" href="/admin">Админ. раздел</a>
            @endif
        </nav>
    </div>
</div>
