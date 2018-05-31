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
        @include('profile.donor.topMenu')
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
                        @php $user = \Illuminate\Support\Facades\Auth::user();  @endphp

                            <div class="content__item row">
                                <div class="left"><img src="{{ asset("storage/$need->cover_path") }}"></div>
                                <div class="right">
                                    <div class="info">
                                        <a href="{{ route('organizations.show', ['id' => $need->id_org]) }}" target="_blank"><h3 class="name">{{ $need->title }}</h3></a>
                                        <h3 class="name">{{ $need->orgName or "" }}</h3>
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
                                            <div class="btn-block"><a href="#" data-modal="#modal3" class="btn blue open-modal" receiver="{{ $need->id }}">Помочь</a></div>
                                        </div>
                                    @endif
                                </div>
                                <div class="circle {{ \App\Classes\StatusOfNeed::getColorStatus($need->status) }}">
                                </div>
                            </div>
                    @endforeach
                </div>
            </div>
        </div>
    </div>
@endsection