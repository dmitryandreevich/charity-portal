<?php
/**
 * Created by PhpStorm.
 * User: Dmitry Andreevich
 * Date: 24.05.2018
 * Time: 22:20
 */
?>
@extends('layouts.app')

@section('main-block')
    <div class="main-block donor-setting">
        @include('profile.consumer.topMenu')
        <div class="donor-setting_content">
            <div class="container">
                <h2 class="title">Настройки</h2>
                <div class="row">
                    <div class="left item">
                        <div class="name">Аккаунт пользователя</div>
                        @include('profile.blocks.avatar')
                        @include('profile.blocks.social')
                    </div>
                    <div class="middle item">
                        <div class="name">Информация</div>
                        <form class="new-org__form" method="post" action="{{ route('profile.update') }}">
                            {{ csrf_field() }}
                            <input type="hidden" name="individual">
                            <div class="list">
                                <input type="text" placeholder="Имя" name="name" value="{{ $data->name or old('name') }}">
                            </div>
                            <div class="list">
                                <input type="text" placeholder="Фамилия" name="sec_name" value="{{ $data->sec_name or old('sec_name') }}">
                            </div>
                            <div class="list">
                                <input type="text" placeholder="Отчество" name="th_name" value="{{ $data->th_name or old('th_name') }}">
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
