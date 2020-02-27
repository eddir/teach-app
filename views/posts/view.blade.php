@extends('layouts.app')

@section('content')
    <div class="row justify-content-md-center">
        <div class="col-xl-6 col-lg-8 col-md-9">
            <div class="card mt-5 mb-5">
                <div class="card-body">
                    <h2>{{ $post->title }}</h2>
                    <div>
                        {!! $post->body !!}
                    </div>
                    <h3>Задания на тему:</h3>
                    <hr>
                    @foreach($tests as $test)
                        <div>
                            <h2>{{ $test->title }}</h2>
                            <p>{{ $test->description }}</p>
                            <a class="btn btn-primary" href="/tests/run.php?test_id={{ $test->id }}">Решать</a>
                        </div>
                        <hr>
                    @endforeach
                </div>
            </div>
        </div>
    </div>
@endsection

@section('title')
    {{ $post->title }}
@endsection