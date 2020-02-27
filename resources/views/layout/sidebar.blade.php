<aside class="col-md-4 blog-sidebar">
    <div class="p-4 mb-3 bg-light rounded">
        <h4 class="font-italic">О блоге</h4>
        <p class="mb-0">Etiam porta <em>sem malesuada magna</em> mollis euismod. Cras mattis consectetur purus sit amet fermentum. Aenean lacinia bibendum nulla sed consectetur.</p>
    </div>

    <div class="p-4 mb-3 bg-light rounded">
        <h4 class="font-italic">Теги</h4>
        @include('posts.tags', ['tags'=> $tagsCloud])
    </div>
</aside><!-- /.blog-sidebar -->
