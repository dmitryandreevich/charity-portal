<?php
/**
 * Created by PhpStorm.
 * User: Dmitry Andreevich
 * Date: 24.05.2018
 * Time: 12:56
 */
?>
<div class="right item">
    <div class="name">Смена пароля</div>
    <form class="new-org__form" action="{{ route('profile.changePassword') }}" method="post">
        {{ csrf_field() }}
        <div class="list">
            <input type="password" placeholder="Текущий пароль" name="oldPassword">
        </div>
        <div class="list">
            <input type="password" placeholder="Введите новый пароль" name="newPassword">
        </div>
        <div class="list">
            <input type="password" placeholder="Повторите пароль" name="newPassword_confirmation">
        </div>
        <div class="btn-block">
            <input type="submit" value="Сменить пароль">
        </div>
    </form>
</div>
