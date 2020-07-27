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
        <a class="navbar-brand" href="/">Teach-app</a>
        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarCollapse"
                aria-controls="navbarCollapse" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarCollapse">
            <ul class="navbar-nav mr-auto">
                <li class="nav-item active">
                    <a class="nav-link" href="/">Главная</a>
                </li>
                <li class="nav-item active">
                    <a class="nav-link" href="/posts">Статьи</a>
                </li>
                <li class="nav-item active">
                    <a class="nav-link" href="/tests">Задания</a>
                </li>
                <li class="nav-item active">
                    <a class="nav-link" href="/my">Мои задания</a>
                </li>
                <li class="nav-item active">
                    <a class="nav-link" href="/my/posts.php">Мои статьи</a>
                </li>
                <li class="nav-item active">
                    <a class="nav-link" href="/stat">Моя статистика</a>
                </li>
            </ul>
            @if(!isset($_SESSION['user_id']))
                <div>
                    <a href="/login" class="btn btn-outline-light my-2 my-sm-0">Войти</a>
                </div>
            @endif
        </div>
    </nav>
</header>
<canvas id="background" style="background-color: #000249;position: absolute;"></canvas>
<!-- Begin page content -->
<main role="main" class="flex-shrink-0">
    <div class="container" id="content">
        @yield('content')
    </div>
</main>

<footer class="footer mt-auto py-3">
    <div class="container">
        <a href="http://digitalwind.ru">
            <img id="bxid_862078" src="http://www.digitalwind.ru/images/ru_logo_20png.png" title="www.digitalwind.ru"
                 border="0" align="left" alt="www.digitalwind.ru" width="143" height="56"/></a>
        <!--LiveInternet counter-->
        <script type="text/javascript">
            document.write('<a class="float-right" href="//www.liveinternet.ru/click" ' +
                'target="_blank"><img src="//counter.yadro.ru/hit?t12.11;r' +
                escape(document.referrer) + ((typeof (screen) == 'undefined') ? '' :
                    ';s' + screen.width + '*' + screen.height + '*' + (screen.colorDepth ?
                    screen.colorDepth : screen.pixelDepth)) + ';u' + escape(document.URL) +
                ';h' + escape(document.title.substring(0, 150)) + ';' + Math.random() +
                '" alt="" title="LiveInternet: показано число просмотров за 24' +
                ' часа, посетителей за 24 часа и за сегодня" ' +
                'border="0" width="88" height="31"><\/a>')
        </script><!--/LiveInternet-->
        <a class="float-right mr-5" href="https://github.com/eddir/teach-app">Github</a>

    </div>
</footer>
<div id="navigator" data-enabled="0">+</div>
<div id="navigator_menu">
    <a href="/posts/add.php">Новая статья</a>
    <a href="/tests/add.php">Новое задание</a>
    <a href="/posts">Прочесть статью</a>
    <a href="/tests">Решить задание</a>
</div>
<div id="navigator_background"></div>
@yield('scripts')
<script src="/js/anim.js"></script>
<script src="/js/main.js"></script>
</body>
</html>
