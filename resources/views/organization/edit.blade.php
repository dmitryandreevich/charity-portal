<?php
/**
 * Created by PhpStorm.
 * User: Dmitry Andreevich
 * Date: 26.05.2018
 * Time: 12:38
 */
?>
@extends('layouts.app')
@section('page-title', 'Редактирование организации - '. $organization->name )
@section('main-block')

    <div class="main-block new-org">
        @include('profile.consumer.blocks.topMenu')
        <div class="new-org_content">
            <div class="container">
                <h2 class="title">Редактирование организации '{{ $organization->name }}'</h2>
                <form class="new-org__form" method="post" action="{{ route('organizations.update', ['organization' => $organization]) }}" enctype="multipart/form-data">
                    {{ csrf_field() }}
                    {{ method_field('PATCH') }}

                    <div class="list w50">
                        <select placeholder="Тип потребителя" name="type_consumer" class="headroom_city sources custom-select">
                            @foreach(\App\Classes\TypesOfOrganizations::typesOrganizations as $key => $type)
                                <option value="{{ $key }}">{{ $type }}</option>
                            @endforeach
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
                        <input type="submit" value="Сохранить" name="send">
                    </div>
                </form>
            </div>
        </div>
    </div>
@endsection
