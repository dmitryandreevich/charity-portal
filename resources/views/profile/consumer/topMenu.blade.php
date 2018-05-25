<?php
/**
 * Created by PhpStorm.
 * User: Dmitry Andreevich
 * Date: 25.05.2018
 * Time: 16:46
 */
?>
<div class="top-menu">
    <div class="container row">
        <div class="top-menu__left">
            <a href="{{ route('organizations.create') }}" class="add">Добавить организацию</a>
            <a href="/" class="add">Добавить потребность</a>
        </div>
        <div class="top-menu__right">
            <ul class="list">
                <li class="item"><a href="/">Организации</a></li>
                <li class="item"><a href="/">Потребности</a></li>
                <li class="item"><a href="/" class="active">Настройки</a></li>
            </ul>
        </div>
    </div>
</div>
