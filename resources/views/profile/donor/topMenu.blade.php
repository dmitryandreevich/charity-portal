<?php
/**
 * Created by PhpStorm.
 * User: Dmitry Andreevich
 * Date: 29.05.2018
 * Time: 13:27
 */
?>
<div class="top-menu">
    <div class="container row">
        <div class="top-menu__left">
            <span class="money">Ваш баланс: <span>{{ \Illuminate\Support\Facades\Auth::user()->balance }} ₽</span></span>
            <a href="#" data-modal="#modal5" class="add open-modal">Пополнить баланс</a>
        </div>
        <div class="top-menu__right">
            <ul class="list">
                <li class="item"><a href="/">Потребности</a></li>
                <li class="item"><a href="{{ route('profile.index') }}">Настройки</a></li>
            </ul>
        </div>
    </div>
</div>
