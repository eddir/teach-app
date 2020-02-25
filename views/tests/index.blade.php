@extends('layouts.app')

@section('content')
    <h1>Тесты</h1>
    @foreach($tests as $test)
        <div>
            <h2>{{ $test->title }}</h2>
            <p>{{ $test->description }}</p>
            <a href="run.php?test_id={{ $test->id }}">Решать</a>
        </div>
    @endforeach
@endsection

@section('title')
    Тесты
@endsection