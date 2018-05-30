<?php
/**
 * Created by PhpStorm.
 * User: Dmitry Andreevich
 * Date: 30.05.2018
 * Time: 11:42
 */
?>
<div class="top-menu">
    <div class="container row">
        <div class="top-menu__left"></div>
        <div class="top-menu__right">
            <ul class="list">
                <li class="item"><a href="{{ route('needs.index') }}">Потребности</a></li>
                <li class="item"><a href="{{ route('profile.index') }}" class="active">Настройки</a></li>
            </ul>
        </div>
    </div>
</div>
