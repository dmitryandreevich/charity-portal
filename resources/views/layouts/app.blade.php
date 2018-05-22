<!DOCTYPE html>
<html lang="{{ app()->getLocale() }}">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="Cache-Control" content="no-cache">
    <meta property="og:title" content="">
    <meta property="og:description" content="">
    <meta property="og:url" content="">
    <meta property="og:image" content="">
    <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1, minimal-ui">
    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <meta http-equiv="X-UA-Compatible" content="IE=edge, chrome=1">
    <meta http-equiv="content-type" content="text/html">
    <meta name="msthemecompatible" content="no">
    <meta name="cleartype" content="on">
    <meta name="HandheldFriendly" content="True">
    <meta name="format-detection" content="telephone=no">
    <meta name="format-detection" content="address=no">
    <meta name="google" value="notranslate">
    <link rel="shortcut icon" href="{{ asset('img/favicon/favicon.png') }}">
    <meta name="msapplication-TileColor" content="#da532c">
    <meta name="msapplication-TileImage" content="img/favicon/mstile-144x144.png">
    <meta name="theme-color" content="#ffffff">
    <link href="{{ asset('scripts/libs/jquery.scrollbar.css') }}" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css?family=Roboto:400,500,700,900&amp;subset=cyrillic,cyrillic-ext,latin-ext" rel="stylesheet">
    <link rel="stylesheet" type="text/css" href="//cdn.jsdelivr.net/gh/kenwheeler/slick@1.8.1/slick/slick.css">
    <link rel="stylesheet" type="text/css" href="//cdn.jsdelivr.net/gh/kenwheeler/slick@1.8.1/slick/slick-theme.css">
    <link href="{{ asset('styles/defaults.css') }}" rel="stylesheet">
    <link href="{{ asset('styles/pages.css') }}" rel="stylesheet">
    <link href="{{ asset('styles/vendors.css') }}" rel="stylesheet"><!-- HTML5 supporting -->
    <!--[if lt IE 9]>
    <![endif]-->
    <title>{{ config('app.name', 'Laravel') }}</title>
</head>

<body>
    <header class="header main-header">
        <div class="container row">
            <div class="logotype"><a href="/" class="logo"><img src="./img/icons/i.header_logo-heart.svg"></a></div>
            <div class="menu row"><a href="/" class="menu_item">Каталог потребителей</a><a href="/" class="menu_item">О проекте</a><a href="/" class="menu_item">Вопросы и ответы</a><a href="/" class="menu_item">Условия</a><a href="/" class="menu_item">Статьи</a><a href="/" class="menu_item">Контакты</a></div><a href="#" data-modal="#modal1" class="main-ava open-modal login">
                <p class="entrance">Вход</p></a>
        </div>
    </header><!-- Navigation -->
    <button type="button" class="js-menu menu-hamburger"><span class="bar"></span></button>
    <nav id="slide-menu">
        <ul><a href="/" class="menu_item">Каталог потребителей</a><a href="/" class="menu_item">О проекте</a><a href="/" class="menu_item">Вопросы и ответы</a><a href="/" class="menu_item">Условия</a><a href="/" class="menu_item">Статьи</a><a href="/" class="menu_item">Контакты</a></ul>
    </nav>

    @yield('main-block')
</body>
    <div id="modal1" class="modal">
        <div class="content"><a href="#" data-id="popup_default" data-animation="scale" class="close-popup">&times;</a>
            <h2 class="title">Регистрация</h2>
            <form class="new-org__form">
                <select placeholder="Благотворитель" name="city" class="headroom_city sources custom-select">
                    <option>Благотворитель</option>
                    <option>Потребитель</option>
                    <option>Волонтёр</option>
                </select>
            </form>
            <div class="bind-account"><a href="" class="fb btn">Регистрация через Вконтакте</a><a href="" class="vk btn">Регистрация через Facebook</a><a href="#" data-modal="#modal2" class="mail btn open-modal">Регистрация через почту</a></div>
        </div>
    </div>
    <div id="modal2" class="modal">
        <div class="content"><a href="#" data-id="popup_default" data-animation="scale" class="close-popup">&times;</a>
            <h2 class="title">Регистрация через почту</h2>
            <form class="new-org__form">
                <select placeholder="Благотворитель" name="city" class="headroom_city sources custom-select">
                    <option>Благотворитель</option>
                    <option>Потребитель</option>
                    <option>Волонтёр</option>
                </select>
            </form>
            <div class="bind-account-small"><a href="" class="vk btn"></a><a href="" class="fb btn"></a></div>
            <div class="right item">
                <div class="list">
                    <input type="password" placeholder="Текущий пароль">
                </div>
                <div class="list">
                    <input type="password" placeholder="Новый пароль">
                </div>
                <div class="list">
                    <input type="password" placeholder="Повторите пароль">
                </div>
                <div class="btn-block">
                    <input type="button" value="Сменить пароль">
                </div>
            </div>
        </div>
    </div>
    <div id="modal3" class="modal">
        <div class="content"><a href="#" data-id="popup_default" data-animation="scale" class="close-popup">&times;</a>
            <h2 class="title">Выбирете способ помочь</h2>
            <form class="new-org__form">
                <select placeholder="Помочь финансово" name="city" class="headroom_city sources custom-select">
                    <option>Помочь финансово</option>
                    <option>Помочь материально</option>
                </select>
            </form>
            <div class="right item">
                <div class="name">Введите желаемую сумму:</div>
                <div class="list">
                    <input type="type" class="i-value"><span class="value">₽</span>
                </div>
                <div class="btn-block">
                    <input type="button" value="Пожертвовать">
                </div>
            </div>
        </div>
    </div>
    <div id="modal4" class="modal">
        <div class="content"><a href="#" data-id="popup_default" data-animation="scale" class="close-popup">&times;</a>
            <h2 class="title">Выбирете способ помочь</h2>
            <div class="right item">
                <div class="list">
                    <input type="type" class="i-value"><span class="value">чел</span>
                </div>
                <div class="btn-block">
                    <input type="button" value="Помочь">
                </div>
            </div>
        </div>
    </div>
    <div id="modal5" class="modal">
        <div class="content"><a href="#" data-id="popup_default" data-animation="scale" class="close-popup">&times;</a>
            <h2 class="title">Пополните свой баланс</h2>
            <form class="new-org__form">
                <select placeholder="От физлица" name="city" class="headroom_city sources custom-select">
                    <option>От физлица</option>
                    <option>Потребитель</option>
                </select>
            </form>
            <div class="right item">
                <div class="name">Введите сумму для пополнения:</div>
                <div class="list">
                    <input type="type" class="i-value"><span class="value">руб</span>
                </div>
                <div class="btn-block">
                    <input type="button" value="Пополнить">
                </div>
            </div>
        </div>
    </div>

    <footer class="footer">
        <div class="container row">
            <div class="copyright">
                <p>© Ангел 3000. Все права защищены. 2018 г.</p>
            </div>
            <div class="footer_menu"><a href="/">Пользовательское соглашение</a><a href="/">Информация о Cookies</a></div>
        </div>
    </footer>
    <script src="//ajax.googleapis.com/ajax/libs/jquery/1.11.2/jquery.min.js"></script>
    <script>
        window.jQuery || document.write('<script src="{{ asset('js/jquery.min.js') }}"><\/script>')
    </script>
    <script src="{{ asset('scripts/animation.js') }}"></script>
    <script src="{{ asset('scripts/jquery.functions.js') }}"></script>
    <script async defer src="https://maps.googleapis.com/maps/api/js?key=AIzaSyD0LSng8h27B1VObCg1pvs0rtti9TPw2Ws&amp;callback=initMap"></script>
    <script type="text/javascript" src="//code.jquery.com/jquery-1.11.0.min.js"></script>
    <script type="text/javascript" src="//code.jquery.com/jquery-migrate-1.2.1.min.js"></script>
    <script src="https://code.jquery.com/ui/1.12.1/jquery-ui.js"></script>
    <script src="//cdn.jsdelivr.net/jquery.magnific-popup/1.0.0/jquery.magnific-popup.min.js"></script><script type="text/javascript" src="https://maps.googleapis.com/maps/api/js?key=AIzaSyDT3OjHXWTK-51yNe1jWDa67cF73QEGwHc&amp;amp;amp;sensor=false"></script>
    <script type="text/javascript" src="//cdn.jsdelivr.net/gh/kenwheeler/slick@1.8.1/slick/slick.min.js"></script>
</html>