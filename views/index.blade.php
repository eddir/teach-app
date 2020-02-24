@extends('layouts.app')

@section('content')
    @if($fromLogin)
        <div class="alert alert-success" role="alert">
            Авторизация пройдена успешно.
        </div>
    @endif
    <h1>Главная</h1>
@endsection

@section('title')
    Главная
@endsection