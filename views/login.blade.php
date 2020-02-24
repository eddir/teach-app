@extends('layouts.app')

@section('content')
    @if($failed)
        <div class="alert alert-danger" role="alert">
            Неверная фраза
        </div>
    @endif
    <div class="row justify-content-md-center">
        <div class="col-xl-6 col-lg-8 col-md-9">
            <div class="card mt-5">
                <div class="card-body">
                    <form class="form-signin" action="passphrase.php" method="post">
                        <h1 class="h3 mb-3 font-weight-normal">Вход</h1>
                        <a class="btn btn-lg btn-light btn-block" href="{{ $google_login_url }}">Google</a>
                        <a class="btn btn-lg btn-light btn-block" href="{{ $vkontakte_login_url }}">ВКонтакте</a>
                        <hr>
                        <label for="passphrase" class="sr-only">Вход по токену</label>
                        <input type="password" id="passphrase" name="passphrase" class="form-control" required=""
                               placeholder="Токен" autofocus="">
                        <button class="btn btn-lg btn-primary btn-block mt-1" type="submit">Войти</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection

@section('title')
    Вход в систему
@endsection