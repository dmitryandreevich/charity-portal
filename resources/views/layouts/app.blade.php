@php
    use App\Classes\TypeOfUser;
@endphp

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
    <link href="{{ asset('styles/edits.css') }}" rel="stylesheet">
    <link href="{{ asset('styles/vendors.css') }}" rel="stylesheet"><!-- HTML5 supporting -->

    <!--[if lt IE 9]>
    <![endif]-->
    <title>{{ config('app.name', 'Laravel') }}</title>
</head>

<body>

    <header class="header main-header">

        <div class="container row">
            <div class="logotype"><a href="/" class="logo"><img src="{{ asset('img/icons/i.header_logo-heart.svg') }}"></a></div>
            <div class="menu row"><a href="{{ route('catalog.index') }}" class="menu_item">Каталог потребителей</a><a href="/" class="menu_item">О проекте</a><a href="/" class="menu_item">Вопросы и ответы</a><a href="/" class="menu_item">Условия</a><a href="/" class="menu_item">Статьи</a><a href="/" class="menu_item">Контакты</a></div>
            @if(\Illuminate\Support\Facades\Auth::check())
                <a href="{{ route('profile.index') }}" class="main-ava">
                    @if(\Illuminate\Support\Facades\Auth::user()->avatar == "")
                        <img src="{{ asset("img/dummy200.png") }}">
                    @else
                        <img src="{{ asset("storage/"  . \Illuminate\Support\Facades\Auth::user()->avatar) }}">
                    @endif
                </a>
                <a href="{{ route('logout') }}" class="main-ava login">
                    <p class="entrance">Выйти</p>
                </a>
            @else
                <a href="#" data-modal="#modal1" class="main-ava open-modal login">
                    <p class="entrance">Регистрация</p>
                </a>
                <a href="#" data-modal="#modal6" class="main-ava open-modal login">
                    <p class="entrance">Вход</p>
                </a>
            @endif



        </div>
    </header><!-- Navigation -->
    <button type="button" class="js-menu menu-hamburger"><span class="bar"></span></button>
    <nav id="slide-menu">
        <ul>
            <a href="/" class="menu_item">Каталог потребителей</a>
            <a href="/" class="menu_item">О проекте</a>
            <a href="/" class="menu_item">Вопросы и ответы</a>
            <a href="/" class="menu_item">Условия</a>
            <a href="/" class="menu_item">Статьи</a>
            <a href="/" class="menu_item">Контакты</a>
        </ul>
    </nav>
    <div class="log" style="border: 1px solid black; background-color: #1f648b">
        @include('layouts.messages')
    </div>

    @yield('main-block')
</body>
    <div id="modal1" class="modal">
        <div class="content"><a href="#" data-id="popup_default" data-animation="scale" class="close-popup">&times;</a>
            <h2 class="title">Регистрация</h2>
            <form class="new-org__form" id="form-action-register" action="{{ route('register.getAccess') }}">
                {{ csrf_field() }}
                <div class="new-org__form">
                    <select placeholder="Благотворитель" name="typeOfUser" class="headroom_city sources custom-select">
                        <option value="{{ TypeOfUser::DONOR }}">Благотворитель</option>
                        <option value="{{ TypeOfUser::CONSUMER }}">Потребитель</option>
                        <option value="{{ TypeOfUser::VOLUNTEER }}">Волонтёр</option>
                    </select>
                </div>
                <div class="new-org__form">
                    <div class="bind-account">
                    <button class="vk btn" type="submit" name="vkAuth">Регистрация через Вконтакте</button>
                    <button class="fb btn" type="submit" name="fbAuth">Регистрация через Facebook</button>
                    <a href="#" data-modal="#modal2" class="mail btn open-modal">Регистрация через почту</a>
                    </div>
                </div>

            </form>

        </div>
    </div>
    <div id="modal2" class="modal">
        <div class="content">
            <a href="#" data-id="popup_default" data-animation="scale" class="close-popup">&times;</a>
            <h2 class="title">Регистрация через почту</h2>
            <form class="new-org__form" method="POST" action="{{ route('register') }}">
                {{ csrf_field() }}
                <select placeholder="Благотворитель" name="typeOfUser" class="headroom_city sources custom-select">
                    <option value="{{ TypeOfUser::DONOR }}">Благотворитель</option>
                    <option value="{{ TypeOfUser::CONSUMER }}">Потребитель</option>
                    <option value="{{ TypeOfUser::VOLUNTEER }}">Волонтёр</option>
                </select>
                <div class="right item">
                    <div class="bind-account-small">
                        <a href="" class="vk btn"></a>
                        <a href="" class="fb btn"></a>
                    </div>
                </div>

                <div class="right item">

                    <div class="list">
                        <input type="email" placeholder="E-mail адрес" name="email">
                    </div>
                    <div class="list">
                        <input type="password" placeholder="Пароль" name="password">
                    </div>
                    <div class="list">
                        <input type="password" placeholder="Повторите пароль" name="password_confirmation">
                    </div>
                    <div class="btn-block">
                        <input type="submit" value="Регистрация">
                    </div>
                </div>
            </form>


        </div>
    </div>
    <div id="modal6" class="modal">
        <div class="content">
            <a href="#" data-id="popup_default" data-animation="scale" class="close-popup">&times;</a>
            <h2 class="title">Авторизуйтесь в системе</h2>
            <form class="new-org__form" method="POST" action="{{ route('login') }}">
                {{ csrf_field() }}
                <div class="right item">
                    <div class="list">
                        <input type="email" placeholder="E-mail адрес" name="email">
                    </div>
                    <div class="list">
                        <input type="password" placeholder="Пароль" name="password">
                    </div>
                    <div class="btn-block">
                        <input type="submit" value="Авторизация">
                    </div>
                </div>
            </form>
            <!-- I`m not a robot -->
            <div class="right item">
                <div class="bind-account-small">
                    <a href="{{ \App\Classes\VkApiHelper::getLinkAuthCode( route('login.vk') ) }}" class="btn vk"></a>
                    <a href="{{ \App\Classes\FbApiHelper::getLinkAuthCode( route('login.fb') ) }}" class="btn fb"></a>
                </div>
            </div>
        </div>
    </div>
    <div id="modal3" class="modal">
        <div class="content"><a href="#" data-id="popup_default" data-animation="scale" class="close-popup">&times;</a>
            <h2 class="title">Выбирете способ помочь</h2>
            <form class="new-org__form" action="{{ route('donation.store') }}" method="post">
                {{ csrf_field() }}

                <select placeholder="Помочь финансово" name="donate_type" class="headroom_city sources custom-select select-donate_type">
                    <option tab-name="finance" value="finance">Помочь финансово</option>
                    <option tab-name="material" value="material">Помочь материально</option>
                </select>

                <div class="right item">
                    <div class="finance">
                        <div class="name">Введите желаемую сумму:</div>
                        <div class="list">
                            <input type="number" class="i-value" name="amount"><span class="value">₽</span>
                        </div>
                        <div class="btn-block">
                            <input type="submit" value="Пожертвовать" name="financeSend">
                        </div>
                    </div>
                    <div class="material" style="display: none">
                        <div class="name">Введите предметы и любую информацию о вас:</div>

                        <div class="list">
                            <textarea placeholder="Введите предметы и любую информацию о том как с вами связаться." name="info"></textarea>
                        </div>
                        <div class="btn-block">
                            <input type="submit" value="Отправить" name="materialSend">
                        </div>
                    </div>
                </div>

            </form>
        </div>
    </div>
    <div id="modalCancelNeed" class="modal">
        <div class="content">
            <h2 class="title">Вы уверены, что хотите отменить данную потребность?</h2>
            <div class="right item">
                <form class="new-org__form" action="{{ route('needs.cancel.store') }}" method="post">
                    {{ csrf_field() }}
                    <div class="btn-block">
                        <input type="submit" value="Отменить" class="btn blue">
                    </div>
                </form>
            </div>
        </div>
    </div>
    <div id="modalReportNeed" class="modal">
        <div class="content">
            <h2 class="title">Введите причину жалобы</h2>
            <div class="right item">
                <form class="new-org__form" action="{{ route('needs.report.store') }}" method="post">
                    {{ csrf_field() }}
                    <div class="list">
                        <input type="text" name="reportMessage" required>
                    </div>
                    <div class="btn-block">
                        <input type="submit" value="Пожаловаться" class="btn blue">
                    </div>
                </form>
            </div>
        </div>
    </div>
    <div id="modalBanNeed" class="modal">
        <div class="content">
            <h2 class="title">Введите причину блокировки потребности</h2>
            <div class="right item">
                <form class="new-org__form" action="{{ route('dashboard.moderation.need.block') }}" method="post">
                    {{ csrf_field() }}
                    <div class="list">
                        <input type="text" name="message" required>
                    </div>
                    <div class="btn-block">
                        <input type="submit" value="Заблокировать" class="btn blue">
                    </div>
                </form>
            </div>
        </div>
    </div>
    <div id="modalBanOrg" class="modal">
        <div class="content">
            <h2 class="title">Введите причину блокировки организации</h2>
            <div class="right item">
                <form class="new-org__form" action="{{ route('dashboard.moderation.org.block') }}" method="post">
                    {{ csrf_field() }}
                    <div class="list">
                        <input type="text" name="message" required>
                    </div>
                    <div class="btn-block">
                        <input type="submit" value="Заблокировать" class="btn blue">
                    </div>
                </form>
            </div>
        </div>
    </div>
    <div id="modalChangeAvatar" class="modal">
        <div class="content">
            <a href="#" data-id="popup_default" data-animation="scale" class="close-popup">&times;</a>
            <h2 class="title">Смена главной фотграфии</h2>
            <form class="new-org__form" method="POST" action="{{ route('profile.changeAvatar.store') }}" enctype="multipart/form-data">
                {{ csrf_field() }}

                <div class="right item">

                    <div class="list">
                        <input type="file" name="image">
                    </div>
                    <div class="btn-block">
                        <input type="submit" value="Установить">
                    </div>
                </div>
            </form>


        </div>
    </div>
    <div id="modal4" class="modal">
        <div class="content"><a href="#" data-id="popup_default" data-animation="scale" class="close-popup">&times;</a>
            <h2 class="title">Введите количество человек</h2>
            <div class="right item">
                <form action="{{ route('volunteers.add') }}" class="new-org__form" method="post">
                    {{ csrf_field() }}
                    <div class="list">
                        <input type="number" class="i-value" name="count"><span class="value">чел</span>
                    </div>
                    <div class="btn-block">
                        <input type="submit" value="Помочь">
                    </div>
                </form>

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
    <script type="text/javascript" src="{{ asset('scripts/ajax.functions.js') }}"></script>
</html>