<div class="row justify-content-md-center">
    <div class="col-xl-9">
        <div class="card mt-4 mb-4">
            <div class="card-body">
                <h1>Ваши задания</h1>
                <hr>
                @foreach($posts as $post)
                    <div>
                        <h2>{{ $post->title }}</h2>
                        <a class="btn btn-primary" href="/tests/run.php?test_id={{ $post->id }}">Перейти</a>
                        <a class="btn btn-danger" href="#" onclick="deletePost({{ $post->id }})">Удалить</a>
                    </div>
                    <hr>
                @endforeach
            </div>
        </div>
    </div>
</div>
<div class="modal" tabindex="-1" role="dialog" id="remove">
    <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Удаление</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <p>Вы уверены, что хотите удалить запись?</p>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-danger" onclick="forceDeletePost()">Удалить</button>
                <button type="button" class="btn btn-primary" data-dismiss="modal">Назад</button>
            </div>
        </div>
    </div>
</div>