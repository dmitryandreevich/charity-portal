@extends('layouts.app')

@section('page-title', 'Главная страница')

@section('main-block')
    <div class="main-block">
        <div class="main-banner">
            <div class="container row">
                <div class="main-banner__info">
                    <h1 class="title">Портал благотворительной помощи нуждающимся</h1>
                    <h2 class="subtitle">Помогайте нуждающимся без просредников и бумажной волокиты. Занимайтесь благотворительностью и волонтёрством, или получите помощь сами!</h2>
                    <div class="btn-block">
                        <a href="#" data-modal="#modal1" class="btn orange open-modal">Получить помощь</a>
                        <a href="#" data-modal="#modal1" class="btn green open-modal">Оказать помощь</a>
                    </div>
                </div>
            </div>
        </div>
        <div class="advantages">
            <div class="container">
                <div class="advantages_list row">
                    <div class="advantages_item"><span class="value">114</span>
                        <p class="descr">Организаций получили помощь</p>
                    </div>
                    <div class="advantages_item"><span class="value">56</span>
                        <p class="descr">Городов участвуют в программе</p>
                    </div>
                    <div class="advantages_item"><span class="value">45</span>
                        <p class="descr">Благотворителей зарегистрировано</p>
                    </div>
                    <div class="advantages_item"><span class="value">16</span>
                        <p class="descr">Организаций еще ждут помощи</p>
                    </div>
                </div>
            </div>
        </div>
        <div class="who_we_help">
            <div class="container">
                <h2 class="title">Как мы помогаем</h2>
                <h3 class="subtitle">Мы уверены, что наше дело - важное. Помогать - просто. На нашем портале любой желающий может жертвовать любые суммы или участвовать в качестве волонтёра, а нуждающиеся - получить помощь.</h3>
                <div class="who_we_help_list row">
                    <div class="who_we_help_item">
                        <div class="top"><img src="./img/icons/i.wallet.svg"></div>
                        <p class="descr">Сбор денег</p>
                    </div>
                    <div class="who_we_help_item">
                        <div class="top"><img src="./img/icons/i.man.svg"></div>
                        <p class="descr">Помощь волонтёров</p>
                    </div>
                    <div class="who_we_help_item">
                        <div class="top"><img src="./img/icons/i.shopping-bag.svg"></div>
                        <p class="descr">Предоставление товаров</p>
                    </div>
                    <div class="who_we_help_item">
                        <div class="top"><img src="./img/icons/i.hold.svg"></div>
                        <p class="descr">Обучение волонтёрству</p>
                    </div>
                </div>
            </div>
        </div>
        <div class="main-slider">
            <div class="container">
                <div class="main-slider_header row">
                    <h2 class="title">Организации, нуждающиеся в помощи</h2><a href="{{ route('catalog.index') }}" class="show-all">Смотреть все</a>
                </div>
                <div class="main-slider_content">
                    @foreach($organizations as $organization)
                        <div class="main-slider_item">
                           <img src="{{ asset('storage/' . $organization->cover_path) }}">
                           <!-- <img src="./img/content/main-slider/item1.png"> -->
                            <div class="content">
                                <a href="{{ route('organizations.show', ['organization' => $organization->id]) }}"><div class="name">{{ $organization->name }}</div></a>
                                <div class="bottom">
                                    <div class="location">{{ $organization->city }}</div>
                                    <div class="help"><img src="./img/icons/i.slider-help_services.svg"><img src="./img/icons/i.slider_help_people.svg"><img src="./img/icons/i.slider_help_things.svg"></div>
                                </div>
                            </div>
                        </div>
                    @endforeach
                </div>
            </div>
        </div>
        <div class="block-needs--help">
            <div class="container">
                <div class="main-slider_header row">
                    <h2 class="title">Организации, нуждающиеся в помощи</h2>
                </div>
                <div class="slider_content">

                    @foreach($organizations as $organization)
                        <div class="main-slider_item">
                            <img src="{{ asset('storage/' . $organization->cover_path) }}">
                            <!-- <img src="./img/content/main-slider/item1.png"> -->
                            <div class="content">
                                <a href="{{ route('organizations.show', ['organization' => $organization->id]) }}"><div class="name">{{ $organization->name }}</div></a>
                                <div class="bottom">
                                    <div class="location">{{ $organization->city }}</div>
                                    <div class="help"><img src="./img/icons/i.slider-help_services.svg"><img src="./img/icons/i.slider_help_people.svg"><img src="./img/icons/i.slider_help_things.svg"></div>
                                </div>
                            </div>
                        </div>
                    @endforeach


                </div><a href="{{ route('catalog.index') }}" class="show-all">Смотреть все</a>
            </div>
        </div>
        <div class="completed-slider">
            <div class="container">
                <div class="main-slider_header">
                    <h2 class="title">Реализованные потребности</h2>
                </div>

                <div class="completed-slider_content">
                    @foreach($realizedNeeds as $need)
                        <div class="completed-slider_item">
                            <div class="left-photo">
                                <img src="{{ asset('storage/' . $need->cover_path ) }}">

                                <div class="checkbox"><img src="./img/icons/i.completed-slider-checkbox.svg"></div>
                            </div>
                            <div class="right-info">
                                <div class="title">{{ \App\Classes\TypeOfNeed::NAMES[$need->type_need] }}</div>
                                <div class="bottom">
                                    <div class="name">{{ $need->title }}</div>
                                    <div class="location">{{ $need->orgCity }}</div>
                                </div>
                            </div>
                        </div>
                    @endforeach
                </div>
            </div>
        </div>
        <div class="main-maps">
            <div class="container">
                <h2 class="title">Мы на карте России</h2>
            </div>
            <div id="map" class="map"></div>
        </div>
        <div class="blue-block">
            <div class="container">
                <div class="btn-block">
                    <a href="#" data-modal="#modal1" class="btn orange open-modal">Получить помощь</a>
                    <a href="#" data-modal="#modal1" class="btn blue open-modal">Оказать помощь</a>
                </div>
            </div>
        </div>
    </div>
@endsection
