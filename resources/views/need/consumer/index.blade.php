<?php
/**
 * Created by PhpStorm.
 * User: Dmitry Andreevich
 * Date: 27.05.2018
 * Time: 13:54
 */
?>
@extends('layouts.app')

@section('main-block')
    <div class="main-block needs">
        @include('profile.consumer.topMenu')
        <div class="catalog_organization-content">
            <div class="container">
                <div class="top">
                    <h2 class="title">Потребности</h2>
                    <div class="select">
                        <select placeholder="Статус" name="city" class="headroom_city sources custom-select">
                            <option>Омск</option>
                            <option>Москва</option>
                            <option>Питер</option>
                        </select>
                        <select placeholder="Организация" name="city" class="headroom_city sources custom-select">
                            <option>Омск</option>
                            <option>Москва</option>
                            <option>Питер</option>
                        </select>
                    </div>
                </div>

                <div class="content__list">
                    @foreach($needs as $need)
                        @php $user = \Illuminate\Support\Facades\Auth::user(); $typeOfNeed = $need->type_need; @endphp

                        @if($typeOfNeed == \App\Classes\TypeOfNeed::VOLUNTEERS)
                            <div class="content__item row">
                                <div class="left"><img src="{{ asset("storage/$need->cover_path") }}"></div>
                                <div class="right">
                                    <div class="info">
                                        <h3 class="name">{{ $need->title }}</h3>
                                        <h3 class="name">Организация</h3>
                                        <h3 class="name">Тип</h3>
                                        <p class="html">{{ $need->description }}</p>
                                        <div class="bottom_item row">
                                            <div class="date descr">Дата создания: <span class="bold">{{ $need->created_at }}</span></div>
                                            <div class="author descr">Координатор: <span class="bold">Иван Викторов</span></div>
                                        </div>
                                    </div>
                                    <div class="end">
                                        <div class="info">
                                            <div class="p-small">Нужно волонтёров:<span>{{ $need->count_vols }} человек</span></div><span class="money">Осталось собрать:<span class="blue">{{ $need->count_vols - $need->collected }} человек</span></span>
                                        </div>

                                        <div class="btn-block"><a href="#" data-modal="#modal4" class="btn blue open-modal">Отменить</a></div>
                                    </div>
                                </div>
                                <div class="circle green"></div>
                            </div>
                        @elseif($typeOfNeed == \App\Classes\TypeOfNeed::COLLECT_MONEY)
                            <div class="content__item row">
                                <div class="left"><img src="{{ asset("storage/$need->cover_path") }}"></div>
                                <div class="right">
                                    <div class="info">
                                        <h3 class="name">{{ $need->title }}</h3>
                                        <h3 class="name">Организация</h3>
                                        <h3 class="name">Тип</h3>
                                        <p class="html">{{ $need->description }}</p>
                                    </div>
                                    @if( ($need->amount - $need->collected ) <= 0.00 )
                                        <div class="end">
                                            <span class="money">Вся сумма собрана<span class="green">{{ $need->amount }} ₽</span></span>
                                            <div class="btn-block"><a href="#" data-modal="#modal3" class="btn blue open-modal">Получить</a></div>
                                        </div>
                                    @else
                                        <div class="end">
                                            <div class="info">
                                                <div class="p-small">Необходимая сумма:<span>{{ $need->amount }} ₽</span></div><span class="money">Осталось собрать:<span class="blue">{{ $need->amount - $need->collected }} ₽</span></span>
                                            </div>
                                            <div class="btn-block"><a href="#" data-modal="#modal4" class="btn blue open-modal">Отменить</a></div>
                                        </div>
                                    @endif
                                </div>
                                <div class="circle green"></div>
                            </div>
                        @endif
                    @endforeach
                </div>
            </div>
        </div>
    </div>
@endsection