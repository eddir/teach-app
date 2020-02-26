@extends('layouts.app')

@section('content')
    @if($fromLogin)
        <div class="alert alert-success" role="alert">
            Авторизация пройдена успешно.
        </div>
    @endif
    <div class="row justify-content-md-center">
        <div class="col-xl-6 col-lg-8 col-md-9">
            <div class="card mt-5 mb-5">
                <div class="card-body">
                    <a class="btn btn-lg btn-primary btn-block" href="/tests/">Доступные тесты</a>
                    <a class="btn btn-lg btn-success btn-block" href="/tests/add.php">Новый тест</a>
                </div>
            </div>
        </div>
    </div>
@endsection

@section('title')
    Главная
@endsection