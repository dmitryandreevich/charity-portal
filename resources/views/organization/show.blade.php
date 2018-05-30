<?php
/**
 * Created by PhpStorm.
 * User: Dmitry Andreevich
 * Date: 25.05.2018
 * Time: 19:30
 */
?>
@extends('layouts.app')

@section('main-block')
    <div class="main-block sp needs">
        <div class="main-banner" style="background:url({{ asset("storage/$organization->cover_path") }}) no-repeat"></div>
        <div class="main-content">
            <div class="container">
                <div class="top">
                    <h2 class="title">{{ $organization->name }}</h2>
                    <div class="location">{{ $organization->address }}</div>
                </div>
                <p class="descr">{{ $organization->description }}.</p>
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
                            <div class="main-slider_item"><img src="./img/content/sp/img_item1.png"></div>
                            <div class="main-slider_item"><img src="./img/content/sp/img_item2.png"></div>
                            <div class="main-slider_item"><img src="./img/content/sp/img_item3.png"></div>
                            <div class="main-slider_item"><img src="./img/content/sp/img_item1.png"></div>
                            <div class="main-slider_item"><img src="./img/content/sp/img_item2.png"></div>
                            <div class="main-slider_item"><img src="./img/content/sp/img_item3.png"></div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="catalog_organization-content">
            <div class="container">
                <div class="top">
                    <div class="left">
                        <h2 class="title">Актуальные потребности</h2><a href="/">Архив</a>
                    </div>
                    <div class="select">
                        <select placeholder="Тип потребности" name="city" class="headroom_city sources custom-select">
                            <option>Омск</option>
                            <option>Москва</option>
                            <option>Питер</option>
                        </select>
                    </div>
                </div>

                <div class="content__list">
                    @foreach($needs as $need)
                        @php $typeOfNeed = $need->type_need; @endphp

                        @if($typeOfNeed == \App\Classes\TypeOfNeed::VOLUNTEERS)
                            <div class="content__item row">
                                <div class="left"><img src="{{ asset("storage/$need->cover_path") }}"></div>
                                <div class="right">
                                    <div class="info">
                                        <h3 class="name">{{ $need->title }}</h3>
                                        <p class="html">{{ $need->description }}</p>
                                        <div class="bottom_item row">
                                            <div class="date descr">Дата: <span class="bold">{{ $need->date_time }}</span></div>
                                        </div>
                                    </div>
                                    <div class="end">
                                        <div class="info">
                                            <div class="p-small">Нужно волонтёров:<span>{{ $need->count_vols }} человек</span></div><span class="money">Осталось собрать:<span class="blue">{{ $need->count_vols - $need->collected }} человек</span></span>
                                        </div>
                                        @if(\Illuminate\Support\Facades\Auth::user()->type == \App\Classes\TypeOfUser::VOLUNTEER)
                                            <div class="btn-block"><a href="#" data-modal="#modal4" class="btn blue open-modal">Помочь</a></div>
                                        @endif
                                    </div>
                                </div>
                            </div>
                        @elseif($typeOfNeed == \App\Classes\TypeOfNeed::COLLECT_MONEY)
                            <div class="content__item row">
                                <div class="left"><img src="{{ asset("storage/$need->cover_path") }}"></div>
                                <div class="right">
                                    <div class="info">
                                        <h3 class="name">{{ $need->title }}</h3>
                                        <p class="html">{{ $need->description }}</p>
                                        <a href="{{ $need->link }}" class="link">{{ $need->link }}</a>
                                    </div>
                                    @if( ($need->amount - $need->collected ) <= 0.00 )
                                        <div class="end">
                                            <span class="money">Вся сумма собрана<span class="green">{{ $need->amount }} ₽</span></span>
                                            <!--<div class="btn-block"><a href="#" data-modal="#modal3" class="btn blue open-modal">Получить</a></div>-->
                                        </div>
                                    @else

                                        <div class="end">
                                            <div class="info">
                                                <div class="p-small">Необходимая сумма:<span>{{ $need->amount }} ₽</span></div><span class="money">Осталось собрать:<span class="blue">{{ $need->amount - $need->collected }} ₽</span></span>
                                            </div>
                                            @if(\Illuminate\Support\Facades\Auth::user()->type == \App\Classes\TypeOfUser::DONOR)
                                                <div class="btn-block"><a href="#" data-modal="#modal3" class="btn blue open-modal" receiver="{{ $need->id }}" >Помочь</a></div>
                                            @endif
                                        </div>

                                    @endif

                                </div>
                            </div>
                        @endif
                    @endforeach



                </div>
            </div>
        </div>
    </div>
@endsection
