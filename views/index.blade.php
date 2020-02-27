@extends('layouts.app')

@section('content')
    @if($fromLogin)
        <div class="alert alert-success" role="alert">
            Авторизация пройдена успешно.
        </div>
    @endif
    <div class="row justify-content-md-center">
        <div class="col-xl-6 col-lg-8 col-md-9">
            <div class="card mt-5 mb-3">
                <div class="card-body">
                    <a class="btn btn-lg btn-primary btn-block" href="/posts/">Доступные материалы</a>
                    <a class="btn btn-lg btn-success btn-block" href="/tests/add.php">Создать задание</a>
                    <a class="btn btn-lg btn-success btn-block" href="/posts/add.php">Создать запись</a>
                </div>
            </div>
            <div class="card mt-3 mb-5">
                <div class="card-body">
                    <h1>Недавние</h1><hr>
                    @foreach($tests as $test)
                        <div>
                            <h2>{{ $test->title }}</h2>
                            <p>{{ $test->description }}</p>
                            <a class="btn btn-primary" href="/tests/run.php?test_id={{ $test->id }}">Решать</a>
                        </div><hr>
                    @endforeach
                </div>
            </div>
        </div>
    </div>
@endsection

@section('title')
    Главная
@endsection