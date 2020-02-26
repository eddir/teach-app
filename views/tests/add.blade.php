@extends('layouts.app')

@section('content')
    <div class="alert alert-success" role="alert" id="alert_success" style="display: none"></div>
    <div class="alert alert-warning" role="alert" id="alert_warning" style="display: none"></div>
    <div class="row justify-content-md-center">
        <div class="col-xl-8 mb-5">
            <div class="card mt-5 mb-5">
                <div class="card-body">
                    <form class="ui large form" method="post" action="newTest.php" enctype="multipart/form-data"
                          id="send_test_form" autocomplete="off">
                        <h2>Шаг 1: описание</h2>
                        <input type="hidden" name="step" value="0" id="step">
                        <div class="form-group">
                            <label for="title">Навзание</label>
                            <input type="text" name="title" id="title" class="form-control" required="">
                        </div>
                        <div class="form-group">
                            <label for="description">Описание</label>
                            <textarea name="description" id="" rows="5" class="form-control"></textarea>
                        </div>
                        <div class="form-group">
                            <label for="per_time">Количество вопросов за тест</label>
                            <input type="number" min="1" max="50" name="per_time" id="per_time" class="form-control"
                                   required="">
                            <small>Оперделяет число вопросов, заданных пользователю до завершения теста.</small>
                        </div>
                        <input type="submit" class="btn btn-primary" value="Далее">

                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection

@section('title')
    Создание теста
@endsection

@section('scripts')
    <script src="/js/admin.js"></script>
@endsection