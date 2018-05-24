<?php
/**
 * Created by PhpStorm.
 * User: Dmitry Andreevich
 * Date: 24.05.2018
 * Time: 22:45
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
                        @include('profile.blocks.avatar')
                        @include('profile.blocks.toggleStatus')
                        @include('profile.blocks.social')
                    </div>
                    <div class="middle item">
                        <div class="name">Информация</div>
                        <form class="new-org__form" action="{{ route('profile.update') }}" method="post">
                            {{ csrf_field() }}
                            <input type="hidden" name="organization">
                            <div class="list">
                                <input type="text" placeholder="Название организации" name="name_org" value="{{ $data->organization->data->name_org or old('name_org') }}">
                            </div>
                            <div class="list">
                                <input type="text" placeholder="Тип организации">
                            </div>
                            <div class="list">
                                <input type="text" placeholder="Город" name="city" value="{{ $user->city or old('city')}}">
                            </div>
                            <div class="list">
                                <input type="number" placeholder="Кол-во волонтёров" name="vol_count" value="{{ $data->organization->data->vol_count or old('vol_count')}}">
                            </div>
                            <div class="list">
                                <input type="tel" placeholder="Телефон" name="phone" value="{{ $user->phone or old('phone')}}">
                            </div>
                            <div class="list">
                                <input type="email" placeholder="Email" name="email" value="{{ $user->email or old('email')}}">
                            </div>
                            <div class="btn-block">
                                <input type="button" value="Сохранить">
                            </div>
                        </form>
                    </div>
                    @include('profile.blocks.changePassword')
                </div>
            </div>
        </div>
    </div>

@endsection
