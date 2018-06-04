<?php
/**
 * Created by PhpStorm.
 * User: Dmitry Andreevich
 * Date: 03.06.2018
 * Time: 12:32
 */
?>
<div class="right item">
    <div class="name">Смена пароля</div>
    <form class="new-org__form" action="{{ route('dashboard.users.reset', ['user' => $user->id]) }}" method="post">
        {{ csrf_field() }}
        <div class="btn-block">
            <input type="submit" value="Сбросить пароль">
        </div>
    </form>
</div>
