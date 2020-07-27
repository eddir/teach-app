@extends('layouts.app')

@section('content')
    @if($fromInsertion)
        <div class="alert alert-success" role="alert">
            Запись добавлена.
        </div>
    @endif
    <div class="row justify-content-md-center">
        <div class="col-lg-9">
            <div class="card mt-5 mb-5">
                <div class="card-body">
                    <h1>Все записи</h1>
                    <hr>
                    @foreach($posts as $post)
                        <div>
                            <h2>{{ $post->title }}</h2>
                            <div class="text-right">
                                <a class="btn btn-primary" href="/posts/view.php?post_id={{ $post->id }}">Перейти</a>
                            </div>
                        </div><hr>
                        @endforeach
                </div>
            </div>
        </div>
    </div>
@endsection

@section('title')
    Записи
@endsection