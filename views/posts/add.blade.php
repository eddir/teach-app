@extends('layouts.app')

@section('content')

    @if($error)
        <div class="alert alert-warning" role="alert">{{ $error }}</div>
    @endif
    <div class="row justify-content-md-center">
        <div class="col-xl-8 mb-5">
            <div class="card mt-5 mb-5">
                <div class="card-body">
                    <form class="ui large form" method="post" action="add.php" enctype="multipart/form-data"
                          id="send_test_form" autocomplete="off">
                        <h2>Добавление записи</h2>
                        <div class="form-group">
                            <label for="title">Заголовок</label>
                            <input type="text" name="title" id="title" class="form-control" required="">
                        </div>
                        <div class="form-group">
                            <label for="test">К заданию</label>
                            <select multiple class="form-control" id="test" name="test[]">
                                @foreach($tests as $test)
                                <option value="{{ $test->id }}">{{ $test->title }}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="form-group">
                            <label for="body">Тело</label>
                            <textarea name="body" id="body" class="form-control" rows="5" required="" minlength="3" maxlength="10000"></textarea>
                        </div>
                        <input type="submit" class="btn btn-primary" value="Отправить">
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection

@section('title')
    Создание записи
@endsection

@section('scripts')

@endsection
