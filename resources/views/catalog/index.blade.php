<?php
/**
 * Created by PhpStorm.
 * User: Dmitry Andreevich
 * Date: 22.05.2018
 * Time: 18:55
 */
?>
@extends('layouts.app')
@section('page-title', 'Каталог организаций')
@section('main-block')
    <div class="main-block catalog">
        <div class="headroom">
            <div class="container">
                <h2 class="title">Каталог организаций</h2>
                <ul class="headroom_list row">
                    <li class="headroom_item big">
                        <select placeholder="Город" name="city" class="headroom_city sources custom-select big filter-select-catalog filter_city">
                            <option>Омск</option>
                            <option>Москва</option>
                            <option>Питер</option>
                        </select>
                    </li>
                    <li class="headroom_item big">
                        <select placeholder="Тип организации" name="type_consumer" class="type sources custom-select big filter-select-catalog filter-type_org">
                            @foreach(\App\Classes\TypesOfOrganizations::typesOrganizations as $key => $type)
                                <option value="{{ $key }}">{{ $type }}</option>
                            @endforeach
                        </select>
                    </li>
                    <li class="headroom_item big">
                        <select placeholder="Вид потребностей" name="view" class="view sources custom-select big filter-select-catalog filter-type_need">
                            <option value="{{ \App\Classes\TypeOfNeed::COLLECT_MONEY }}">Сбор денег</option>
                            <option value="{{ \App\Classes\TypeOfNeed::VOLUNTEERS }}">Помощь волонтёров</option>
                        </select>
                    </li>
                    <li class="headroom_item select-small">
                        <select placeholder="Сортировка" name="sort" class="sources custom-select big filter-select-catalog sort-type_catalog_all">
                            <option value="date">По дате добавления</option>
                            <option value="actual_needs">По актуальным потребностям</option>
                        </select>
                    </li>
                </ul>
            </div>
        </div>
        <div class="block-needs--help catalog_flex">
            @include('catalog.blocks.organizations')
        </div>
    </div>
@endsection
