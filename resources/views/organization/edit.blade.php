<?php
/**
 * Created by PhpStorm.
 * User: Dmitry Andreevich
 * Date: 26.05.2018
 * Time: 12:38
 */
?>
@extends('layouts.app')

@section('main-block')

    <div class="main-block new-org">
        @include('profile.consumer.topMenu')
        <div class="new-org_content">
            <div class="container">
                <h2 class="title">Новая Организация</h2>
                <form class="new-org__form" method="post" action="{{ route('organizations.update', ['organization' => $organization]) }}" enctype="multipart/form-data">
                    {{ csrf_field() }}
                    {{ method_field('PATCH') }}

                    <div class="list w50">
                        <select placeholder="{{ $organization->type_consumer }}" name="type_consumer" class="headroom_city sources custom-select">
                            <option value="Детский дом" selected>Детский дом</option>
                            <option value="Социальный приют">Социальный приют</option>
                            <option value="Интернат для детей-инвалидов">Интернат для детей-инвалидов</option>
                            <option value="Дом престарелых">Дом престарелых</option>
                            <option value="Реабилитационный центр">Реабилитационный центр</option>
                            <option value="Психоневрологический интернат">Психоневрологический интернат</option>
                            <option value="Хоспис">Хоспис</option>
                            <option value="Больница">Больница</option>
                            <option value="Роддом">Роддом</option>
                            <option value="Детский сад">Детский сад</option>
                            <option value="Школа">Школа</option>
                            <option value="ВУЗ">ВУЗ</option>
                            <option value="Дом ребёнка">Дом ребёнка</option>
                            <option value="Приют для животных">Приют для животных</option>
                        </select>
                        <select placeholder="Выберите город" name="city" class="headroom_city sources custom-select">
                            <option value="Омск">Омск</option>
                            <option value="Москва">Москва</option>
                            <option value="Питер">Питер</option>
                        </select>
                    </div>
                    <div class="list">
                        <input type="text" placeholder="Адрес организации" name="address" value="{{ $organization->address or old('address') }}">
                    </div>
                    <div class="list">
                        <input type="text" placeholder="Название организации" name="name" value="{{ $organization->name or old('name') }}">
                    </div>
                    <div class="list">
                        <textarea placeholder="Описание организации" name="description">{{ $organization->description or old('description') }}</textarea>
                    </div>
                    <div class="add-file">
                        <div class="file-upload">
                            <label>
                                <input type="file" name="cover" value="{{ old('cover') }}"><span>Изменить обложку</span>
                            </label>
                        </div>
                        <!--<div class="file-upload">
                            <label>
                                <input type="file" multiple name="photos[]" value="{{ old('photos[]') }}"><span>Загрузить фотографии</span>
                            </label>
                        </div>-->
                        <div class="file-upload">
                            <label>
                                <input type="file" name="docs" value="{{ old('docs') }}"><span>Изменить документы для прохождения модерации</span>
                            </label>
                        </div>
                    </div>
                    <div class="btn-block">
                        <button class="btn" type="submit" name="preview" formtarget="_blank">Предварительный просмотр</button>
                        <input type="submit" value="Отправить на модерацию" name="send">
                    </div>
                </form>
            </div>
        </div>
    </div>
@endsection