@extends('layouts.app')

@section('content')
    <div class="row justify-content-md-center">
        <div class="col-lg-9">
            <div class="card mt-5 mb-5">
                <div class="card-body">
                    <h1>Доступные для решения тесты</h1><hr>
                    @foreach($tests as $test)
                        <div>
                            <h2>{{ $test->title }}</h2>
                            <p>{{ $test->description }}</p>
                            <a class="btn btn-primary" href="run.php?test_id={{ $test->id }}">Решать</a>
                        </div><hr>
                    @endforeach
                </div>
            </div>
        </div>
    </div>
@endsection

@section('title')
    Тесты
@endsection