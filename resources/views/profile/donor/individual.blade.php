<?php
/**
 * Created by PhpStorm.
 * User: Dmitry Andreevich
 * Date: 24.05.2018
 * Time: 10:08
 */
?>
@extends('layouts.app')

@section('main-block')
    <div class="main-block donor-setting">
        <div class="top-menu">
            <div class="container row">
                <div class="top-menu__left"></div>
                <div class="top-menu__right">
                    <ul class="list">
                        <li class="item"><a href="/">Потребности</a></li>
                        <li class="item"><a href="/" class="active">Настройки</a></li>
                    </ul>
                </div>
            </div>
        </div>
        <div class="donor-setting_content">
            <div class="container">
                <h2 class="title">Настройки</h2>
                <div class="row">
                    <div class="left item">
                        <div class="name">Аккаунт пользователя</div>
                        <a href="/"><img src="/../img/content/account/img-ac.png"></a>
                        <form action="" method="post">
                            {{ csrf_field() }}
                            <div class="radio-row">
                                <div class="radio-button">
                                    <input id="radio-1" name="radio" type="radio" {{ $data->individual->active ? "checked" : "" }}>
                                    <label for="radio-1" class="radio-label">Физическое лицо</label>
                                </div>
                                <div class="radio-button">
                                    <input id="radio-2" name="radio" type="radio" {{ $data->organization->active ? "checked" : "" }}>
                                    <label for="radio-2" class="radio-label">Организация</label>
                                </div>
                            </div>
                        </form>

                        @include('profile.blocks.social')
                    </div>
                    <div class="middle item">
                        <div class="name">Информация</div>
                        <form class="new-org__form" action="{{ route('profile.update') }}" method="post">
                            {{ csrf_field() }}
                            <input type="hidden" name="individual">
                            <div class="list">
                                <input type="text" placeholder="Имя" name="name" value="{{ $data->individual->data->name or old('name') }}">
                            </div>
                            <div class="list">
                                <input type="text" placeholder="Фамилия" name="sec_name" value="{{ $data->individual->data->sec_name or old('sec_name') }}">
                            </div>
                            <div class="list">
                                <input type="text" placeholder="Отчество" name="th_name" value="{{ $data->individual->data->th_name or old('th_name') }}">
                            </div>
                            <div class="list">
                                <input type="text" placeholder="Город" name="city" value="{{ $user->city or old('city') }}">
                            </div>
                            <div class="list">
                                <input type="tel" placeholder="Телефон" name="phone" value="{{ $user->phone or old('phone') }}">
                            </div>
                            <div class="list">
                                <input type="email" placeholder="Email" name="email" value="{{ $user->email or old('email') }}">
                            </div>
                            <div class="btn-block">
                                <input type="submit" value="Сохранить">
                            </div>
                        </form>
                    </div>
                    @include('profile.blocks.changePassword')
                </div>
            </div>
        </div>
    </div>

@endsection
