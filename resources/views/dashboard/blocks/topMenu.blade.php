<?php
/**
 * Created by PhpStorm.
 * User: Dmitry Andreevich
 * Date: 02.06.2018
 * Time: 12:03
 */
?>
<div class="top-menu">
    <div class="container row">

        <div class="top-menu__left">
            <a href="{{ route('dashboard.users.index') }}" class="add plclear">Пользователи</a>
            <a href="{{ route('dashboard.organizations.index') }}" class="add plclear">Страницы потребителей</a>
            <a href="{{ route('dashboard.needs.index') }}" class="add plclear">Потребности</a>
            <a href="{{ route('dashboard.moderation.index') }}" class="add plclear">Модерация</a>
            <a href="{{ route('dashboard.payments.index') }}" class="add plclear">Заявки на вывод средств</a>


        </div>
        <div class="top-menu__right">
            <ul class="list">
                <li class="item">
                        @php
                            use Illuminate\Support\Facades\Route;
                            $uri = Route::getFacadeRoot()->current()->uri();
                            $page = str_replace('dashboard/', "", $uri);
                        @endphp
                        <input type="hidden" name="page" class="page" value="{{ $page }}">
                        <input type="text" class="i-value" name="search-attr">

                        <button class="btn blue dashboard-search">Найти</button>
                </li>
            </ul>
        </div>

    </div>
</div>

