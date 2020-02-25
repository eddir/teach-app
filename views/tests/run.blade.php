@extends('layouts.app')

@section('content')

    <div class="row justify-content-md-center">
        <div class="col-xl-6 col-lg-8 col-md-9">
            <div class="card mt-5 mb-5">
                <div class="card-body">
                    <form class="form">
                        <h1 id="title">Вопрос ?/?</h1>
                        <div id="question"><p>Вопрос</p></div>
                        <div id="answers"></div>
                        <div id="result"></div>
                        <a href="#" id="answer" class="btn btn-primary">Далее</a>
                        <div id="control" style="display: none">
                            <a href="javascript:location.reload(true)" id="reload" class="btn btn-warning">Заново</a>
                            <a href="/tests/" id="reload" class="btn btn-warning">В меню</a>
                        </div>

                    </form>
                    <div class="ui blue inverted segment" id="description" style="display: none"></div>
                </div>
            </div>
        </div>
    </div>
@endsection

@section('title')
    Решение теста
@endsection

@section('scripts')
    <script src="/js/test.js"></script>
@endsection