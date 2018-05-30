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
                    <h2 class="title">Потребности с вашим участием</h2>
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
                        @php $user = \Illuminate\Support\Facades\Auth::user(); @endphp
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
                                            <div class="p-small">Нужно волонтёров:<span>{{ $need->count_vols }} человек</span></div>
                                            <span class="money">Осталось собрать:<span class="blue">{{ $need->count_vols - $need->collected }} человек</span></span>
                                        </div>
                                    </div>
                                </div>
                                <div class="circle green"></div>
                            </div>
                    @endforeach
                </div>
            </div>
        </div>
    </div>
@endsection