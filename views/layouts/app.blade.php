<!doctype html>
<html lang="ru" class="h-100">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="">
    <title>@yield('title')</title>

    <!-- Bootstrap core CSS -->
    <link href="/css/bootstrap.min.css" rel="stylesheet">
    <meta name="theme-color" content="#007bff">
    <link href="/css/main.css" rel="stylesheet">
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.1.1/jquery.min.js"></script>
    <script src="/js/bootstrap.bundle.min.js"></script>
</head>
<body class="d-flex flex-column h-100">
<header>
    <!-- Fixed navbar -->
    <nav class="navbar navbar-expand-md navbar-dark bg-primary fixed-top">
        <a class="navbar-brand" href="#">Teach-app</a>
        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarCollapse"
                aria-controls="navbarCollapse" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarCollapse">
            <ul class="navbar-nav mr-auto">
                <li class="nav-item active">
                    <a class="nav-link" href="/">Главная <span class="sr-only">(текущая)</span></a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="/tests">Все задания</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="/my">Мои задания</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="/stat">Моя статистика</a>
                </li>
            </ul>
            <div>
                <a href="/login" class="btn btn-outline-light my-2 my-sm-0">Войти</a>
            </div>
        </div>
    </nav>
</header>

<!-- Begin page content -->
<main role="main" class="flex-shrink-0">
    <div class="container" id="content">
        @yield('content')
    </div>
</main>

<footer class="footer mt-auto py-3">
    <div class="container">
        <img id="bxid_862078" src="http://www.digitalwind.ru/images/ru_logo_20png.png" title="www.digitalwind.ru" border="0" align="left" alt="www.digitalwind.ru" width="143" height="56" />
    </div>
</footer>
@yield('scripts')
</body>
</html>
