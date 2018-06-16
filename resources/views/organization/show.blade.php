<?php
/**
 * Created by PhpStorm.
 * User: Dmitry Andreevich
 * Date: 25.05.2018
 * Time: 19:30
 */
?>
@extends('layouts.app')
@section('page-title', "Страница организации - $organization->name")
@section('main-block')
    <div class="main-block sp needs">
        <div class="main-banner" style="background:url({{ asset("storage/$organization->cover_path") }}) no-repeat; background-position: center; background-size:cover;"></div>
        <div class="main-content">
            <div class="container">
                <div class="top">
                    <h2 class="title">{{ $organization->name }}</h2>
                    <div class="location">{{ $organization->address }}</div>
                </div>
                <div class="top">
                    <h4 class="title">Общая сумма собранных пожертвований <b>{{ $totalMoney }}₽</b></h4>
                </div>
                <div class="top">
                    <h4 class="title">Общее количество волонтёров, помогающих нам <b>{{ $totalVols }} человек.</b></h4>
                </div>
                <p class="descr">{{ $organization->description }}.</p>
                <p class="totalMoney"> </p>
                <div class="main-slider">
                    <div class="container">
                        <div class="main-slider_header row"></div>
                        <div class="main-slider_content">
                            @foreach($photos as $photo)
                                <div class="main-slider_item"><img src="{{ asset($photo) }}"></div>
                            @endforeach
                        </div>
                    </div>
                </div>
                <div class="block-needs--help">
                    <div class="container">
                        <div class="slider_content">
                            @foreach($photos as $photo)
                                <div class="main-slider_item"><img src="{{ asset($photo) }}"></div>
                            @endforeach
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="catalog_organization-content">
            <div class="container">
                <div class="top">
                    <div class="left">
                        <a href="{{ route('organizations.show', ['organization' => $organization->id]) }}"><h2 class="title">Актуальные потребности</h2></a>
                        <a href="{{ route('organizations.archive.index', ['organization' => $organization->id]) }}">Архив</a>
                    </div>
                    <div class="select">
                        <input type="hidden" class="orgId" value="{{ $organization->id }}">

                        <select placeholder="Тип потребности" name="city" class="headroom_city sources custom-select sort-select-org filter_type-need">

                        @for($i = 1; $i < count(\App\Classes\TypeOfNeed::NAMES); $i++)
                                <option value="{{ $i }}">{{ \App\Classes\TypeOfNeed::NAMES[$i] }}</option>
                            @endfor
                        </select>
                    </div>
                </div>
                <div class="content__list">
                   @include('organization.blocks.orgContent')
                </div>
            </div>
        </div>
    </div>
@endsection
