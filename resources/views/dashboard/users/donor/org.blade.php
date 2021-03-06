<?php
/**
 * Created by PhpStorm.
 * User: Dmitry Andreevich
 * Date: 24.05.2018
 * Time: 10:08
 */
?>
@extends('layouts.app')
@section('page-title', 'Просмотр профиля пользователя')
@section('main-block')
    <div class="main-block donor-setting">
        <div class="donor-setting_content">
            <div class="container">
                <h2 class="title">Настройки</h2>
                <div class="row">
                    <div class="left item">
                        <div class="name">Аккаунт пользователя</div>
                        @include('dashboard.users.blocks.avatar')

                    </div>
                    <div class="middle item">
                        <div class="name">Реквизиты</div>
                        <form class="new-org__form" method="post" action="">
                            {{ csrf_field() }}
                            <input type="hidden" name="organization">
                            <div class="list">
                                <input type="text" placeholder="Название организации" name="name_org" value="{{ $data->organization->data->name_org or old('name_org') }}" disabled>
                            </div>
                            <div class="list">
                                <input type="text" placeholder="Юридический адрес" name="address_org" value="{{ $data->organization->data->address_org or old('address_org') }}" disabled>
                            </div>
                            <div class="list">
                                <input type="text" placeholder="ИНН" name="inn" value="{{ $data->organization->data->inn or old('inn') }}" disabled>
                            </div>
                            <div class="list">
                                <input type="text" placeholder="ОГРН" name="ogrn" value="{{ $data->organization->data->ogrn or old('ogrn') }}" disabled>
                            </div>
                            <div class="list">
                                <input type="text" placeholder="Банк" name="bank" value="{{ $data->organization->data->bank or old('bank') }}" disabled>
                            </div>
                            <div class="list">
                                <input type="text" placeholder="БИК" name="bik" value="{{ $data->organization->data->bik or old('bik') }}" disabled>
                            </div>
                            <div class="list">
                                <input type="text" placeholder="Рассч. счёт" name="ch_account" value="{{ $data->organization->data->ch_account or old('ch_account') }}" disabled>
                            </div>
                            <div class="list">
                                <input type="number" placeholder="Кор. счёт" name="corp_account" value="{{ $data->organization->data->corp_account or old('corp_account') }}" disabled>
                            </div>
                            <div class="list">
                                <input type="text" placeholder="КПП" name="kpp" value="{{ $data->organization->data->kpp or old('kpp') }}" disabled>
                            </div>
                            <div class="list">
                                <input type="text" placeholder="Генеральный директор" name="ceo" value="{{ $data->organization->data->ceo or old('ceo') }}" disabled>
                            </div>
                            <div class="bottom">
                                <div class="list">
                                    <input type="tel" placeholder="Телефон" name="phone" value="{{ $user->phone or old('phone') }}" disabled>
                                </div>
                                <div class="list">
                                    <input type="email" placeholder="Email" name="email" value="{{ $user->email or old('email') }}" disabled>
                                </div>
                            </div>
                            <!--<div class="btn-block">
                                <input type="submit" value="Сохранить">
                            </div>-->
                        </form>
                    </div>
                    @include('dashboard.users.blocks.dropPassword')
                </div>
            </div>
        </div>
    </div>
@endsection
