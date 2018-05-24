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
                        <div class="name">Аккаунт пользователя</div><a href="/"><img src=".././img/content/account/one-world.png"></a>
                        <div class="radio-row">
                            <div class="radio-button">
                                <input id="radio-1" name="radio" type="radio">
                                <label for="radio-1" class="radio-label">Физическое лицо</label>
                            </div>
                            <div class="radio-button">
                                <input id="radio-2" name="radio" type="radio" >
                                <label for="radio-2" class="radio-label">Организация</label>
                            </div>
                        </div>
                        @include('profile.blocks.social')
                    </div>
                    <div class="middle item">
                        <div class="name">Реквизиты</div>
                        <form class="new-org__form" method="post" action="{{ route('profile.update') }}">
                            {{ csrf_field() }}
                            <input type="hidden" name="organization">
                            <div class="list">
                                <input type="text" placeholder="Название организации" name="name_org">
                            </div>
                            <div class="list">
                                <input type="text" placeholder="Юридический адрес" name="address_org">
                            </div>
                            <div class="list">
                                <input type="text" placeholder="ИНН" name="inn">
                            </div>
                            <div class="list">
                                <input type="text" placeholder="ОГРН" name="ogrn">
                            </div>
                            <div class="list">
                                <input type="text" placeholder="Банк" name="bank">
                            </div>
                            <div class="list">
                                <input type="text" placeholder="БИК" name="bik">
                            </div>
                            <div class="list">
                                <input type="text" placeholder="Рассч. счёт" name="ch_account">
                            </div>
                            <div class="list">
                                <input type="number" placeholder="Кор. счёт" name="corp_account">
                            </div>
                            <div class="list">
                                <input type="text" placeholder="КПП" name="kpp">
                            </div>
                            <div class="list">
                                <input type="text" placeholder="Генеральный директор" name="ceo">
                            </div>
                            <div class="bottom">
                                <div class="list">
                                    <input type="tel" placeholder="Телефон" name="phone">
                                </div>
                                <div class="list">
                                    <input type="email" placeholder="Email" name="email">
                                </div>
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
